<?php

class Common {
	/*
	* Method to strip tags globally.
	*/
	public static function globalXssClean() {
		// Recursive cleaning for array [] inputs, not just strings.
		$sanitized = static::arrayStripTags(Input::get());
		Input::merge($sanitized);
	}

	public static function arrayStripTags($array) {
		$result = array();

		foreach ($array as $key => $value) {
		    // Don't allow tags on key either, maybe useful for dynamic forms.
		    $key = strip_tags($key);

		    // If the value is an array, we will just recurse back into the
		    // function to keep stripping the tags out of the array,
		    // otherwise we will set the stripped value.
		    if (is_array($value)) {
		        $result[$key] = static::arrayStripTags($value);
		    } else {
		        // I am using strip_tags(), you may use htmlentities(),
		        // also I am doing trim() here, you may remove it, if you wish.
		        $result[$key] = trim(strip_tags($value));
		    }
		}

		return $result;
	}

	public static function removeOldBoosts() {
		foreach(BoostUser::all() as $u_b) {
			$now = new DateTime;

			if($u_b->finished < $now->format('Y-m-d H:i:s')) {
				$u_b->delete();
			}
		}
	}

	public static function checkUserAgent() {
		if(empty($_SERVER['HTTP_USER_AGENT'])) {
			throw new Exception("Error Processing Request", 1);			
		}
	}
}