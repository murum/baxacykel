<?php

use Carbon\Carbon;

class ChatMessage extends Eloquent {
	protected $table = 'chat_messages';

	public function user() {
		return $this->belongsTo('User');
	}

	public function get_message_time() {
		$date = new Datetime($this->created_at);		
        return $date->format('H:i:s');
    }
}