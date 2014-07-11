<?php

class Attribute extends Eloquent {
	public function users() {
		return $this->belongsToMany('User')->with('point');
	}

	public function courses() {
		return $this->hasMany('Course');
	}
}