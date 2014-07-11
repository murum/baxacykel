<?php

Event::listen('auth.login', function($user)
{
    $user->last_login = new DateTime;

    $user->save();
});

User::updating(function($user) {
    // Create a ruond user if it doesn't exists
    if(Round::any_active_round()) {
        $current_round = Round::get_current_round();
        $round_user = RoundUser::where('round_id', '=', $current_round->id)
                        ->where('user_id', '=', $user->id)
                        ->get();

        if(count($round_user) == 0) {
            $round_user = new RoundUser();
            $round_user->round_id = $current_round->id;
            $round_user->user_id = $user->id;
            $round_user->save();
        }
    }

    // Check the users level and increase the level if the users experience is above the current levels required experience.
    $level = (floor(pow(($user->experience/100), (1/2))));

    if ($level > $user->level) {
        $user->level = $level;

        if($level % 5 == 0 && $level <= 99) {
        	$user->pedals += 1;
        	Session::flash('success', 'Grattis, du gick upp i level du är nu Level '.$user->level.'! eftersom du levlade en speciell level fick du även 1 pedal');
        } else if( $level == 100 ){
        	$user->pedals += 6;
        	Session::flash('success', 'Grattis, du gick upp i level du är nu Level '.$user->level.'! eftersom du levlade en speciell level fick du även 6 pedaler');
        }
        else {
        	Session::flash('success', 'Grattis, du gick upp i level du är nu Level '.$user->level.'!');
        }
    }
});

User::created(function($user) {
	foreach(Attribute::all() as $attribute) {
		$user->attributes()->attach($attribute->id, array('point' => 1));
	}

	foreach(Item::all() as $item) {
		$user->items()->attach($item->id, array('in_storage' => 5));
	}

    foreach(Factory::all() as $factory) {
        $user->factories()->attach($factory->id, array('upgrade' => 0));
    }

	$user->save();
});