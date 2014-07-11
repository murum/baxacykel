<?php

class IdeaController extends BaseController {

    public function postIdea() {
        $user_id = Input::get('user_id');

        if(isset($user_id)) {
            if(Auth::user()->id != $user_id) {
                $user_id = null;
            }
        }

        $data = array();
        $data['username'] = isset($user_id) ? User::find($user_id)->username : null;
        $data['idea'] = Input::get('idea');
        $data['msg'] = Input::get('message');

        $validator = Validator::make(Input::all(), Idea::$rules);
 
        if ($validator->passes()) {

            $idea = new Idea;
            $idea->user_id = isset($user_id) ? $user_id : null;
            $idea->idea = Input::get('idea');
            $idea->message = Input::get('message');
            $idea->save();

            if ( Mail::send('emails.idea', $data, function($message)
                {
                    $message->to('admin@baxacykel.se')->subject('Idé till baxacykel.se');
                })
            ) {
                return Redirect::to('/bug-dev')->with('success', 'Din idé blev skickad, Tack för att du hjälper till!');
            }
        } else {
            return Redirect::to('/bug-dev#idea')->withErrors($validator)->withInput();
        }
    }

}