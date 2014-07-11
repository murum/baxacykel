<?php

class ItemMarket extends Eloquent {
	public $table = 'item_market';
	
	public function market() {
		return $this->belongsTo('Market');
	}

	public function item() {
		return $this->belongsTo('Item');
	}
}