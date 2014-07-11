<?php

class PaymentController extends BaseController {

    public function process() {

        if (Input::has('pedals') && Input::has('password')) {

            header('Content-Type: text/html;charset=iso-8859-1');

            $pedals = Input::get('pedals');
            $password = Input::get('password');

            if ($password == 'azC3-lo9z-rofl') { //The password needed, if by any chance someone would find out the url

                $sms = urldecode(Input::get('sms'));

                $pieces = explode(' ', $sms);

                $username = (isset($pieces[2]) ? $pieces[2] : null); //The third element would be the username

                if ($username !== null)
                    $user = User::where('username' , '=', $username)->first(); //Get the User by Username
                else
                    $user = false;

                //If we find a User

                if ( $user ) {

                    $user->pedals += $pedals;
                    $user->save();

                    echo mb_convert_encoding('Vi har nu fyllt på ditt konto med ' . $pedals . ' pedaler, ' . e($username) . '!', 'iso-8859-1', 'utf-8');

                } else {

                    echo mb_convert_encoding('Vi kunde inte hitta användaren med användarnamn ' . e($username) . ', Stavade du rätt? kontakta oss för hur du går tillväga om du skickade fel i ditt sms!', 'iso-8859-1', 'utf-8');

                }

            } 

        }
    }

}