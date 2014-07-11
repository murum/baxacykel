<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	Common::globalXssClean();

	Common::removeOldBoosts();

	Common::checkUserAgent();
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('/');
});


Route::filter('round.is_active', function() {
	//Logout the user if there's no active round
    if( !Round::any_active_round() ) {
        // Create Round user if it doesn't exist
        Round::set_all_users_end_result();
        if( ! Round::is_reseted() ) {
        	if( User::resetUsersForNewRound() ) {
        		Round::mark_last_reseted();
        	}
    	}

        return Redirect::to('/topplista');
    }
});

Route::filter('auth.has_town', function()
{
	if( !Auth::guest() ) {
		$user = Auth::user();
		if($user->town_id == null) {
			return Redirect::to('/valj-stad');
		}
	}
	else {
		return Redirect::guest('/');
	}
});

Route::filter('auth.home_town', function()
{
	if( !Auth::guest() ) {
		$user = Auth::user();
		if(!$user->inHomeTown()) {
			return Redirect::to('/resor')->with('warning', 'Du är inte i din hemstad');
		}
	}
	else {
		return Redirect::guest('/');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('no_ajax', function()
{
	if(Request::ajax()) {
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});