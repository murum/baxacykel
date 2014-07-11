<?php

class AuthController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function postLogin() {
        if (Auth::attempt(array('username' => Input::get('login-username'), 'password' => Input::get('login-password')))) {
            $user = Auth::user();

            // Create Round user if it doesn't exist
            $current_round = Round::get_current_round();
            try {
                $round_user = RoundUser::where('round_id', '=', $current_round->id)
                            ->where('user_id', '=', $user->id)
                            ->firstOrFail();

            if(count($round_user) == 0) {
                $round_user = new RoundUser();
                $round_user->round_id = $current_round->id;
                $round_user->user_id = $user->id;
                $round_user->save();
            }

            
            if($user->items()->count() == 0) {
                $user->items()->attach($item->id, array('in_storage' => 0));
            }

            if($user->factories()->count() == 0) {
                $user->factories()->attach($factory->id, array('upgrade' => 0));
            }

            return Response::json( array('success' => true, 'data' => 'Du är nu inloggad.'));

            } catch (Exception $e) {
                return Response::json( array('success' => true, 'data' => 'Du är nu inloggad.'));
            }
        } else {
            Input::flash();
            return Response::json( array('success' => false, 'data' => 'Angiven inloggningsinformation stämmer ej överens.'));
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/')->with('message', 'Du är nu utloggad!');        
    }

    public function getRegister() {
        $ref_user_id = Input::get('referral_user');
        $ref_user = isset($ref_user_id) ? $ref_user_id : null;
        if( $ref_user ) {
            try {
                $ref_user = User::find($ref_user_id)->firstOrFail();
            } catch (Exception $e) {
                $ref_user = null;
            }
        }

        $this->layout->content = View::make('auth.register')
            ->with('referral_user', $ref_user);        
    }

    public function postRegister() {
        $validator = Validator::make(Input::all(), User::$rules);
        $rules = Input::get('rules');
        if(!isset($rules)) {
            return Redirect::to('/registrering')->with('error', 'Du måste acceptera villkoren och reglerna.')->withInput();
        }
 
        if ($validator->passes()) {
            $user = new User;
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));

            if (Input::has('reference_username')) {

                $refuser = User::where('username', '=', Input::get('reference_username'))->first();

                if ($refuser) {
                    $user->ref_user_id = $refuser->id;
                } else {
                    return Redirect::to('/registrering')->with('error', 'Referensanvändaren hittades inte! Skrev du in rätt namn?')->withInput();
                }
            }


            if($user->save()) {
                Auth::login($user);
                
                // Fire the login event
                $event = Event::fire('auth.login', array($user));
            }

            return Redirect::to('/baxa')->with('message', 'Användaren registrerades!');
        } else {
            return Redirect::to('/registrering')->withErrors($validator)->withInput();
        }
    }

}