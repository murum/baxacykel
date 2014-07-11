<?php

class Town extends Eloquent {
	protected $table = 'towns';

	public function club() {
		return $this->belongsTo('Club');
	}
}