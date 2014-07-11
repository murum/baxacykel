<?php

class Payment extends Eloquent {
	protected $table = 'payments';

	protected $fillable = array('txn_id', 'user_id', 'paypal_id');

}