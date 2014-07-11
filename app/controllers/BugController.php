<?php

class BugController extends BaseController {

    public function postReport() {
        $user_id = Input::get('user_id');

        if(isset($user_id)) {
            if(Auth::user()->id != $user_id) {
                $user_id = null;
            }
        }

        $data = array();
        $data['username'] = isset($user_id) ? User::find($user_id)->username : null;
        $data['page'] = Input::get('page');
        $data['prio'] = Input::get('prio');
        $data['msg'] = Input::get('message');

        $validator = Validator::make(Input::all(), Bug::$rules);
 
        if ($validator->passes()) {

            $bug = new Bug;
            $bug->user_id = isset($user_id) ? $user_id : null;
            $bug->page = Input::get('page');
            $bug->prio = Input::get('prio');
            $bug->message = Input::get('message');
            $bug->save();

            if ( Mail::send('emails.bugs', $data, function($message)
                {
                    $message->to('admin@baxacykel.se', 'Bugg på Baxacykel.se')->subject('Buggrapport!');
                })
            ) {
                return Redirect::to('/bug-dev')->with('success', 'Din rapport blev skickad, Tack för att du hjälper till!');
            }
        } else {
            return Redirect::to('/bug-dev#bug')->withErrors($validator)->withInput();
        }
    }

}