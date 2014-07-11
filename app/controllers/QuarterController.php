<?php

class QuarterController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $user = Auth::user();

        $current_garage = Garage::find(Auth::user()->garage_id);

        $current_vehicle = Vehicle::find(Auth::user()->vehicle_id);

        
        $this->layout->content = View::make('quarter.index')
        	->with('user', $user)
        	->with('current_garage', $current_garage)
        	->with('current_vehicle', $current_vehicle);
    }


    public function postBuyGarage() {
    	if (Input::has('garage_id')) {
    		try {
		        $garage = Garage::findOrFail(Input::get('garage_id'));

		        $user = Auth::user();

		        if ($garage->price > $user->money) {
		            $message = 'Du har inte råd med det här garaget!';
		            return Redirect::to('/mitt-kvarter#quarter-garage')->with('error', $message);
		        }

		        $user->garage_id = $garage->id;
		        $user->money -= $garage->price;
		        $user->save();


		        $message = 'Grattis! Du har nu köpt ' . $garage->name . '!';
		        return Redirect::to('/mitt-kvarter#quarter-garage')->with('success', $message);
		    } catch (Exception $e) {
    			return Redirect::to('/mitt-kvarter#quarter-garage')->with('error', 'Du försökte köpa ett garage som ej existerar.');
    		}
        }
    }

    public function postBuyVehicle() {
    	if (Input::has('vehicle_id')) {
    		try {
		        $vehicle = Vehicle::findOrFail(Input::get('vehicle_id'));

		        $user = Auth::user();

		        if ($vehicle->price > $user->money) {
		            $message = 'Du har inte råd med det här fordonet!';
		            return Redirect::to('/mitt-kvarter#quarter-vehicle')->with('error', $message);
		        }

		        if($vehicle->required_level > $user->level) {
		        	$message = 'Du är i för låg level för att bemästra det här fordonet!';
		        	return Redirect::to('/mitt-kvarter#quarter-vehicle')->with('error', $message);
		        }

		        $user->vehicle_id = $vehicle->id;
		        $user->money -= $vehicle->price;
		        $user->save();


		        $message = 'Grattis! Du har nu köpt ' . $vehicle->name . '!';
		        return Redirect::to('/mitt-kvarter#quarter-vehicle')->with('success', $message);
		    } catch (Exception $e) {
    			return Redirect::to('/mitt-kvarter#quarter-vehicle')->with('error', 'Du försökte köpa ett fordon som ej existerar.');
    		}
        }
    }

    public function postStorage() {
    	$amount = Input::get('amount');

    	$item_id = Input::get('item_id');
    	$item = Item::find($item_id);
    	$user = Auth::user();
    	$empty_vehicle_space = $user->vehicle->size - $user->getVehicleItemCount();

    	if(!is_numeric($amount)) {
    		return Redirect::to('/mitt-kvarter#quarter-storage')->with('error', 'Vänligen ange en siffra i fältet för antal varor att lasta på/av.');
    	}
        if((int)$amount < 0) {
            return Redirect::to('/mitt-kvarter#quarter-storage')->with('error', 'Vänligen ange ett positivt värde för antalet varor att lasta på/av.');
        }

    	if(Input::get('action-vehicle')) {
    		if( $empty_vehicle_space == 0 ) {
    			return Redirect::to('/mitt-kvarter#quarter-storage')->with('error', 'Ditt fordon är fullt');
    		}

    		$item_user = $user->getItem($item_id);

    		// if there's no items of this type on the current market 
    		if( $item_user->in_storage == 0) {
    			return Redirect::to('/mitt-kvarter#quarter-storage')->with('error', 'Det fanns ingen/inget '.$item->name.' i lagret!');
    		}

    		// If the user tries to add more items than what's possible in the current vehicle set the value to the empty space of the vehicle
    		if($empty_vehicle_space < $amount) {
    			$amount = $empty_vehicle_space;
    		}

    		if($item_user->in_storage >= $amount) {
    			$amount_to_load = $amount;
    		} else {
    			$amount_to_load = $item_user->in_storage;
    		}
			
			$item_user->in_vehicle += $amount_to_load;
			$item_user->in_storage -= $amount_to_load;

    		$item_user->save();
    		$user->save();

    		$message = 'Du lastade på '.$amount_to_load.'st '.$item->name.'.';
    		return Redirect::to('/mitt-kvarter#quarter-storage')->with('success', $message);

    	} else if(Input::get('action-storage')) {
    		$item_user = $user->getItem($item_id);

    		// If the user tries to sell more than what's in the vehicle
    		if($item_user->in_vehicle < $amount) {
    			return Redirect::back()->with('error', 'Du försökte lasta av mer än vad du har i fordonet');
    		}

    		// Remove items from the user
    		$item_user->in_vehicle -= $amount;
    		$item_user->in_storage += $amount;

    		$item_user->save();
    		$user->save();

    		$message = 'Du lastade av '.$amount.'st '.$item->name.'.';
    		return Redirect::to('mitt-kvarter#quarter-storage')->with('success', $message);
    	} else {

    	}
    }

}