<?php

class MarketController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $market = Market::where('town_id', '=', Auth::user()->current_town)->first();
        
        $this->layout->content = View::make('market.index')
       		->with('market', $market);
    }

    public function postMarket() {
    	$amount = Input::get('amount');
    	$item_id = Input::get('item_id');
    	$item = Item::find($item_id);
    	$user = Auth::user();
    	$empty_vehicle_space = $user->vehicle->size - $user->getVehicleItemCount();

    	$market = Market::where('town_id', '=', Auth::user()->current_town)->first();

        if(!is_numeric($amount) && $amount < 0) {
            return Redirect::back()->with('error', 'Vänligen ange en siffra i fältet för antal varor att köpa/sälja.');
        }
        if((int)$amount < 0) {
            return Redirect::back()->with('error', 'Vänligen ange ett positivt värde för antalet varor att köpa/sälja.');
        }

    	if(Input::get('action-buy')) {

    		if( $empty_vehicle_space == 0 ) {
    			return Redirect::back()->with('error', 'Ditt fordon är fullt');
    		}

    		$item_market = $market->getItem($item_id);
    		$item_user = $user->getItem($item_id);

    		// If the user tries to buy more items than what's possible in the current vehicle set the value to the empty space of the vehicle
    		if($empty_vehicle_space < $amount) {
    			$amount = $empty_vehicle_space;
    		}

    		if($item_market->amount >= $amount) {
    			$amount_to_buy = $amount;
    			$buy_cost = $item_market->price * $amount_to_buy;
    		} else {
    			$amount_to_buy = $item_market->amount;
    			$buy_cost = $item_market->price * $amount_to_buy;
    		}

    		// If the user has enough money
    		if($user->money > $buy_cost) {
    			$user->money -= $buy_cost;
    			$item_user->in_vehicle += $amount_to_buy;
    		} 
    		// If the user doesn't have enough money, buy the amount the user can afford
    		else {
    			 $amount_to_buy = (int)floor($user->money / $item_market->price);
    			 $buy_cost = $amount_to_buy * $item_market->price;

    			 $user->money -= $buy_cost;
    			 $item_user->in_vehicle += $amount_to_buy;
    		}


    		// if there's no items of this type on the current market 
    		if( $item_market->amount == 0) {
    			return Redirect::back()->with('error', 'Det fanns ingen/inget '.$item->name.' på marknaden!');
    		}

    		// If the user can't afford a single item of this item
    		if( $amount_to_buy == 0) {
    			return Redirect::back()->with('error', 'Du hade inte råd med en/ett '.$item->name.'!');
    		}

    		$item_market->amount -= $amount_to_buy;
    		$item_market->save();
    		$item_user->save();
    		$user->save();

    		$message = 'Du köpte '.$amount_to_buy.'st '.$item->name.' för totalt '.$buy_cost.'kr';
    		return Redirect::to('marknad')->with('success', $message);

    	} else if(Input::get('action-sell')) {
			$item_market = $market->getItem($item_id);
    		$item_user = $user->getItem($item_id);

    		// If the user tries to sell more than what's in the vehicle
    		if($item_user->in_vehicle < $amount) {
    			return Redirect::back()->with('error', 'Du försökte sälja mer än vad du har i fordonet');
    		}

    		// Count the price
    		$sell_price = $amount * $item_market->price;
    		$user->money += $sell_price;

    		// Remove items from the user
    		$item_user->in_vehicle -= $amount;

    		// Add items to the market item
    		$item_market->amount += $amount;

    		$item_market->save();
    		$item_user->save();
    		$user->save();

    		$message = 'Du sålde '.$amount.'st '.$item->name.' för totalt '.$sell_price.'kr';
    		return Redirect::to('marknad')->with('success', $message);
    	} else {

    	}
    }


    public function putCronUpdate() {
        $item_markets = ItemMarket::all();
        foreach ($item_markets as $item_market) {
            $item = Item::find($item_market->item_id);

            $item_market->price = mt_rand($item->min_price, $item->max_price);
            $item_market->amount = floor($item_market->amount * 0.5);
            if ( $item_market->amount < 0 )
            {
                $item_market->amount = 0;
            }

            $item_market->save();
        }
    }
}