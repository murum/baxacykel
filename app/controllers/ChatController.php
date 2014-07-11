<?php

class ChatController extends BaseController {

    protected $layout = 'templates.layout.master';
    
    public function getIndex() {
    	$messages = ChatMessage::where('message', '!=', 0)->limit(50)->orderBy('id', 'desc')->get();
    	return View::make('chat.index')
    		->with('messages', $messages);
    }

    public function postMessage() {
    	$user = Auth::user();

    	$message = new ChatMessage;
    	$message->user_id = $user->id;
    	$message->message = Input::get('message');
    	
        if($message->message != '') {
    		if( $message->save() ) {

			    DB::table('users')->where('id', '!=', $user->id)->update(array('chat_noticed' => '0'));
            }
		}
    	return Redirect::to('/chatt');
    }
    public function putRead() {
        $user = Auth::user();

        $user->chat_noticed = 1;
        $user->save();
    }
}