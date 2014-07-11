<?php

class Round extends Eloquent {
	protected $table = 'rounds';

	public static function get_current_round() {
		$current_round = null;
		$current_date = new DateTime();


		foreach(Round::all() as $round) {
			// If rounds startdatetime is smaller than current datetime
			// And rounds enddatetime is bigger than current datetime
			// Then return the current round.
			if( $round->start < $current_date->format('Y-m-d H:i:s') 
				&& $round->end > $current_date->format('Y-m-d H:i:s') ) {
				return $round;
			}
		}

		// If there's no round right now then return false.
		return false;
	}

	public static function any_active_round() {
		$current_date = new DateTime();

		foreach(Round::all() as $round) {
			// If rounds startdatetime is smaller than current datetime
			// And rounds enddatetime is bigger than current datetime
			// Then return the current round.
			if( $round->start < $current_date->format('Y-m-d H:i:s') 
				&& $round->end > $current_date->format('Y-m-d H:i:s') ) {
				return true;
			}
		}

		return false;
	}

	public static function set_all_users_end_result() {
		if(!self::any_active_round()) {
			$date = new DateTime;
			$current_round = Round::where('end', '<=', $date)->get()->last();
	        $round_users = RoundUser::where('round_id', '=', $current_round->id)
	                        ->get();

	        foreach ($round_users as $round_user) {
	            if( !$round_user->money ) {
	                $round_user->money = $round_user->user->money;
	                $round_user->level = $round_user->user->level;
	                $round_user->experience = $round_user->user->experience;
	                $round_user->save();
	            }
	        }
        }
	}

	public static function is_reseted() {
		if(!self::any_active_round()) {
			$date = new DateTime;
			$current_round = Round::where('end', '<=', $date)->get()->last();

			return $current_round->is_reseted;	        
        }
        return false;
	}

	public static function mark_last_reseted() {
		if(!self::any_active_round()) {
			$date = new DateTime;
			$current_round = Round::where('end', '<=', $date)->get()->last();

			$current_round->is_reseted = true;
			$current_round->save();
        }
        return false;
	}

	public static function get_time_left_of_current_round($percent = false) {
		$current_round = self::get_current_round();
		if( !Round::any_active_round() ) {
			return 0;
		}

		$current_date = new DateTime();

		// Get the time left of the current round
		$time_left = strtotime($current_round->end) - strtotime($current_date->format('Y-m-d H:i:s'));

		// Get a swedish text explanation of the time.
		$time_string = time_to_string( $time_left );

		// If the return value should be in percent
		if($percent) {
			$total_time = strtotime($current_round->end) - strtotime($current_round->start);
			$percent_left = 100 - floor(($time_left / $total_time) * 100);
			return $percent_left;
		}

		return $time_string." kvar";
	}
}