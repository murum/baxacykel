<?php

class ItemUser extends Eloquent {
	public $table = 'item_user';
	
	public function user() {
		return $this->belongsTo('User');
	}

	public function item() {
		return $this->belongsTo('Item');
	}
}