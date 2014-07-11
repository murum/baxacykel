<?php

class UserController extends BaseController {

    protected $layout = 'templates.layout.master';
    
    public function getNoticeRead() {
    	$user = Auth::user();

    	$user->noticed = 1;
    	if($user->save()) {
    		return Redirect::back();
    	}
    }

    public function getChooseTown() {
        $user = Auth::user();

        if($user->town_id == null) {
            $this->layout->content = View::make('user.choose_town')
                ->with('towns', Town::all());
        } else {
            return Redirect::to('/baxa');
        }
    }

    public function postChooseTown() {
        $user = Auth::user();

        if($user->town_id == null) {
            try {
                $town = Town::findOrFail(Input::get('town_id'));
                $user->town_id = $town->id;
                $user->current_town = $town->id;

                if( $user->save() ) {
                    return Redirect::to('/baxa')->with('success', 'Härligt '.$user->name.' du har nu skaffat dig ett kvarter i '.$town->name);
                } else {
                    return Redirect::to('/valj-stad')->with('error', 'Någonting gick fel.. vänligen försök igen');
                }
            } catch (Exception $e) {
                return Redirect::to('/valj-stad')->with('error', 'Du försökte välja en stad som inte existerar, vänligen försök med en vanligare stad'); 
            }
        } else {
            return Redirect::back();
        }
    }

    public function getProfile($id) {
        $user = User::find($id);

        $this->layout->content = View::make('user.profile')
       		->with('user', $user);
    }

    public function getEditProfile($id) {
        if(Auth::user()->id == $id) {
        	$user = User::find($id);

        	$this->layout->content = View::make('user.edit_profile')
       			->with('user', $user);
   		} else {
   			return Redirect::to('/')->with('warning', 'Du har ej rättigheter att ändra den information kring den här användaren');
   		}
    }

    public function putEditProfile($id) {        
    	if(Input::get('email') != '') {
	        $user = User::find($id);
	        $user->fill(Input::except('password'));

	        // New password?
	        if(Input::get('password') && Input::get('password') !== ''){
	            $user->password = Hash::make(Input::get('password'));
	        }
	        if (Input::hasFile('profile_picture')) {
	            $image_path = Image::upload(Input::file('profile_picture'), 'anvandare/' . $user->id, false);
	            $profile_picture = Image::resize($image_path, null, null, 150);
	            $user->profile_picture = $profile_picture;
	            unlink($image_path);
	        }
	        
	        $user->save();
	        return Redirect::back()->with('user', $user);
        } else {
        	return Redirect::back()->with('error', 'Du har fyllt i otillräckligt med information');
        }
    }
}