<?php

class Factory extends Eloquent {
    protected $table = 'factories';

    public function users() {
		return $this->belongsToMany('User')->withPivot('latest_delivery','upgrade');
	}

	public function item() {
		return $this->belongsTo('Item');
	}
}