<?php

class Market extends Eloquent {
	protected $table = 'markets';

	public function club() {
		return $this->belongsTo('Club');
	}

	public function items() {
		return $this->belongsToMany('Item')->withPivot('price', 'amount');
	}

	public function getItem($item_id) {
		return ItemMarket::
			where('market_id', '=', $this->id)
			->where('item_id', '=', $item_id)
			->first();
	}
}