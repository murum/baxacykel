<?php

class RoundUser extends Eloquent {
	public $table = 'round_user';
	
	public function round() {
		return $this->belongsTo('Round');
	}

	public function user() {
		return $this->belongsTo('User');
	}
}