<?php

class Idea extends Eloquent {
	public $table = 'ideas';

	public static $rules = array(
	    'idea'=>'required',
	    'message'=>'required'
    );

	public function user() {
		return $this->belongsTo('User');
	}
}