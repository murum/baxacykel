<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StatisticController extends BaseController {

	protected $layout = 'templates.layout.master';

	public function getToplist()
	{
        $users = User::orderBy('money', 'DESC')->where('money', '>=', 10000)->take(10)->get();
        $clubs = Club::all();

        if (Cache::has('toplist_users'))
        {
            $users = Cache::get('toplist_users');        
        } else {
            $users = User::orderBy('money', 'DESC')->where('money', '>=', 10000)->take(10)->get();
            Cache::put('toplist_users', $users, 60);
        }

        if(Cache::has('last_update')) {
            $last_update = Cache::get('last_update');
        } else {
            $last_update = new DateTime;
            Cache::put('last_update', $last_update, 60);
        }

        if (Cache::has('toplist_clubs'))
        {
            $clubs = Cache::get('toplist_clubs');
        } else {
            $clubs = Club::all();
            Cache::put('toplist_clubs', $clubs, 60);
        }

		$this->layout->content = View::make('statistic.toplist')
            ->with('users', $users)
            ->with('last_update', $last_update)
            ->with('clubs', $clubs);
	}
}