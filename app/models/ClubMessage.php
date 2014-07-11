<?php

use Carbon\Carbon;

class ClubMessage extends Eloquent {
	protected $table = 'club_messages';

	public function user() {
		return $this->belongsTo('User');
	}

	public function club() {
		return $this->belongsTo('User');
	}

	public function get_message_time() {
		$date = new Datetime($this->created_at);		
        return $date->format('H:i:s');
    }
}