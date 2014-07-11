<?php

class Item extends Eloquent {
    protected $table = 'items';

    public function markets() {
		return $this->belongsToMany('Market')->withPivot('price', 'amount');
	}

	public function users() {
		return $this->belongsToMany('Users')->withPivot('in_storage','in_vehicle');
	}
}