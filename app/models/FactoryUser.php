<?php

class FactoryUser extends Eloquent {
    protected $table = 'factory_user';

    public function user() {
		return $this->belongsTo('User');
	}

	public function factory() {
		return $this->belongsTo('Factory');
	}


	// Custom delivery
	public function getFactoryLoad() {
		$seconds_since_delivery = $this->_getSecondsSinceLastDelivery();

		$item_time = $this->factory->item->evolve_time;
		
		$upgrade_factor = pow(($this->upgrade + 1), 2) * 8;

		$loaded_amount = (int)($seconds_since_delivery / ($item_time / $upgrade_factor));


		return $loaded_amount;
	}	

	public function getUpgradePrice() {
		$price = pow(($this->upgrade + 2), (3.5)) * 10000;

		return $price;
	}

	public function getActivatePrice() {
		return '10000' * Auth::user()->level;
	}

	public function deliveryItems() {
		$item_amount = $this->getFactoryLoad();
		$user = Auth::user();
		$item_user = $user->getItem($this->factory->item_id);
		$item_user->in_storage += $item_amount;

		if($item_user->save()) {
			return true;
		} else {
			return false;
		}
	}

	private function _getSecondsSinceLastDelivery() {
		$now = new DateTime();

		if($this->latest_delivery) {
			$diff_in_seconds = (int)((strtotime($now->format('Y-m-d H:i:s')) - strtotime($this->latest_delivery)));
		} else {
			$diff_in_seconds = (int)((strtotime($now->format('Y-m-d H:i:s')) - strtotime($this->activated)));
		}

		return $diff_in_seconds;
	}
}