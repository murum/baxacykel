<?php

class ClubUser extends Eloquent {
	public $table = 'club_user';
	public $timestamps = false;
	
	public function user() {
		return $this->belongsTo('User');
	}

	public function club() {
		return $this->belongsTo('Club');
	}
}