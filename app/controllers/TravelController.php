<?php

class TravelController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $towns = Town::all();
        
        $this->layout->content = View::make('travel.index')
        	->with('towns', $towns);
    }

 	public function postTravel() {
        $user = Auth::user();
        try {
        	$town = Town::findOrFail(Input::get('town_id'));
        	$user->current_town = $town->id;

	        if($user->save()) {
	        	return Redirect::to('marknad')->with('success', 'Du reste till '.$town->name);
	        } else {
	        	return Redirect::to('resor')->with('error', 'Du ramlade av bussen påväg till '.$town->name.', vänligen försök igen');
	        }
        } catch (Exception $e) {
        	return Redirect::to('resor')->with('error', 'Staden du försökte resa till finns ej');        	
        }
    }

}