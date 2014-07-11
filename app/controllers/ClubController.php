<?php

class ClubController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {

        $club = Auth::user()->clubs()->first();
        if( $club ) {
            $club = $club->pivot->approved ? $club : null;
        }

        if ( ! $club) {
            
            $this->layout->content = View::make('club.join')
                ->with('clubs', Club::all());

        } else {

            // Mark chat as read
            $club_user = ClubUser::
                where('user_id', '=', Auth::user()->id)
                ->where('club_id', '=', $club->id)
                ->first();
            $club_user->chat_read = true;
            $club_user->save();


            $is_member = $club->is_member();
            $is_appling = $club->is_appling();
            $is_owner = (Auth::user()->id == $club->owner);
            $this->layout->content = View::make('club.index')
                ->with('club', $club)
                ->with('is_owner', $is_owner)
                ->with('is_member', $is_member)
                ->with('is_appling', $is_appling);

        }
    }

    public function getClub($id) {
        $club = Club::find($id);

        if($club) {
            $is_member = $club->is_member();
            $is_appling = $club->is_appling();
            $is_owner = (Auth::user()->id == $club->owner);
            $this->layout->content = View::make('club.index')
                ->with('club', $club)
                ->with('is_owner', $is_owner)
                ->with('is_member', $is_member)
                ->with('is_appling', $is_appling);
        } else {
            return Redirect::to('klubb')->with('error', 'Klubben existerar inte!');
        }
    }

    public function doClubApplication($id) {
        $club = Club::find($id);
        $user = Auth::user();
        if($club) {
            $club->users()->save($user);

            return Redirect::to('klubb/'.$id)->with('success', 'Din ansökan blev anmäld!');
        } else {
            return Redirect::to('klubb')->with('error', 'Klubben existerar inte!');
        }
    }

    public function create() {

        $has_club = Auth::user()->clubs()->first();
        $user = Auth::user();

        if ( $has_club ) {
            return Redirect::to('klubb')->with('error', 'Du tillhör redan en klubb!');
        } else {
            $validator = Validator::make(Input::all(), Club::$rules);

            if ($validator->passes()) {
                $user->money -= 10000000;
                if($user->money > 0) {
                    if($user->save()) {
                        $club = new Club();
                        $club->name = Input::get('name');
                        $club->owner = $user->id;
                        $club->save();

                        $club->users()->save($user);

                        $club_user = ClubUser::where('user_id', '=', $user->id)->first();

                        $club_user->approved = true;
                        $club_user->save();
                        
                        return Redirect::to('klubb')->with('success', 'Du har nu skapat en klubb!');
                    }

                } else {
                    return Redirect::to('klubb')->with('error', 'Du hade ej råd att skapa en klubb!');
                }
            }
            return Redirect::to('klubb')->withErrors($validator)->withInput();
        }
    }

    public function deleteClub() {
        $club = Auth::user()->clubs()->first();

        $is_owner = (Auth::user()->id == $club->owner);

        if($is_owner) {
            if($club->delete()) {
                return Redirect::to('klubb')->with('success', 'Du har nu rivit upp klubben klubben');
            } else {
                return Redirect::to('klubb')->with('error', 'Ett fel inträffade vid upprivningen av klubben');
            }
        }
    }

    public function saveDescription() {
        $club = Auth::user()->clubs()->first();

        $description = Input::get('description');

        $is_owner = (Auth::user()->id == $club->owner);

        if($is_owner) {
            $club->description = $description;
            if($club->save()) {
                return Redirect::to('klubb')->with('success', 'Du har nu uppdaterad klubbens beskrivning');
            } else {
                return Redirect::to('klubb')->with('error', 'Ett fel inträffade vid uppdateringen av klubben');
            }
        }
    }

    public function leaveClub($id) {
        $club_user = ClubUser::where('user_id', '=', $id)->first();

        // Is is owner
        $club = Club::find($club_user->club_id);
        $is_owner = (Auth::user()->id == $club->owner);

        // If the id is the current users id
        if($id == Auth::user()->id) {
            if($club_user->delete()) {
                return Redirect::to('klubb')->with('success', 'Du har nu lämnat klubben');
            } else {
                return Redirect::to('klubb')->with('error', 'Ett oväntat fel inträffade när du försökte lämna klubben!');
            }
        } 
        // If the current user is clubowner, he kicks a member
        else if( $is_owner ) {
            if($club_user->delete()) {
                return Redirect::to('klubb')->with('success', 'Du har nu sparkat ut medlemmen '.$club_user->user->username.' ur klubben');
            } else {
                return Redirect::to('klubb')->with('error', 'Ett oväntat fel inträffade när du försökte sparka ut klubbmedlemmen '.$club_user->user->username.'!');
            }
        } else {
            return Redirect::to('klubb')->with('warning', 'Du har inte rättigheter för att kicka den här medlemmen!');   
        }
    }

    public function acceptUser() {
        $club_user_id = Input::get('user');

        try {
            $club_user = ClubUser::find($club_user_id);
            $club_users = ClubUser::where('user_id', '=', $club_user->user_id)->get();

            // Delete all other pending requests to club
            foreach ($club_users as $club_user_to_reject) {
                if($club_user->id != $club_user_to_reject->id) {
                    $club_user_to_reject->delete();
                }
            }
            
            $club = Club::find($club_user->club_id);

            $is_owner = (Auth::user()->id == $club->owner);

            if($is_owner) {
                $club_user->approved = 1;
                if( $club_user->save() ) {
                    return Redirect::to('klubb')->with('success', 'Medlemmen '.$club_user->user->first()->username.' lades till i klubben!');
                } else {
                    return Redirect::to('klubb')->with('error', 'Ett oväntat fel inträffade vid sparning av klubbmedlemmen, vänligen försök igen!');
                }
            } else {
                return Redirect::to('klubb')->with('error', 'Du är ej ägaren av klubben som tillhör den här användaren');
            }
        } catch (Exception $e) {
            return Redirect::to('klubb')->with('error', 'Klubbanvändaren finns ej');
        }
    }

    public function declineUser() {
        $club_user_id = Input::get('user');

        try {
            $club_user = ClubUser::find($club_user_id)->get();
            
            $club = Club::find($club_user->club_id)->first();

            $is_owner = (Auth::user()->id == $club->owner);

            if($is_owner) {
                if( $club_user->delete() ) {
                    return Redirect::to('klubb')->with('success', 'Medlemmen '.$club_user->user()->get()->username.' nekades tillträde i klubben!');
                } else {
                    return Redirect::to('klubb')->with('error', 'Ett oväntat fel inträffade vid sparning av klubbmedlemmen, vänligen försök igen!');
                }
            } else {
                return Redirect::to('klubb')->with('error', 'Du är ej ägaren av klubben som tillhör den här användaren');
            }
        } catch (Exception $e) {
            return Redirect::to('klubb')->with('error', 'Klubbanvändaren finns ej');
        }

    }

    public function postClubMessage() {
        $user = Auth::user();

        $message = new ClubMessage;
        $message->user_id = $user->id;
        $message->club_id = $user->clubs->first()->id;
        $message->message = Input::get('message');

        if($message->message != '') {
            if( $message->save() ) {

                $club = Club::find($message->club_id);

                foreach( $club->users as $club_user ) {
                    if( $club_user->id == $user->id ) {
                        $club_user->pivot->chat_read = true;
                    } else {
                        $club_user->pivot->chat_read = false;
                    }
                    $club_user->pivot->save();
                }
            }
        }
        return Redirect::to('/klubb')->with('success', 'Ditt meddelande skapades!');
    }

}