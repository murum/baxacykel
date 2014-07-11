<?php

class AttributeUser extends Eloquent {
	public $table = 'attribute_user';
	public $timestamps = false;
	
	public function user() {
		return $this->belongsTo('User');
	}

	public function attribute() {
		return $this->belongsTo('Attribute');
	}
}