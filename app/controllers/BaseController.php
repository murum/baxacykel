<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		View::composer('templates.layout.master', function($view)
		{
		    $view
		    	->with('date', date('Y/m/d'))
		    	->with('days_left', Round::get_time_left_of_current_round())
		    	->with('percent_left', Round::get_time_left_of_current_round(true))
		    	->with('inlogged_users', User::getInloggedUsers());
		});
	}

}