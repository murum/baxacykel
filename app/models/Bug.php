<?php

class Bug extends Eloquent {
	public $table = 'bugs';

	public static $rules = array(
	    'page'=>'required',
	    'prio'=>'required',
	    'message'=>'required'
    );

	public function user() {
		return $this->belongsTo('User');
	}
}