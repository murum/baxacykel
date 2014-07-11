<?php

class DealerController extends BaseController {

    protected $layout = 'templates.layout.master';
    
    public function getDealer() {
        $this->layout->content = View::make('dealer.index')
            ->with('dealers', Dealer::all());
    }

    public function postDealer() {

        if (Input::has('dealer_id')) {
            try {
                $experience_per_bike = 2;

                $dealer = Dealer::findOrFail(Input::get('dealer_id'));

                $user = Auth::user();

                if ($user->bikes == 0) {
                    return Redirect::to('handlare')->with('error', 'Du har inga cyklar att sälja!');
                }

                if ($user->bikes > $dealer->max_bikes) {
                    return Redirect::to('handlare')->with('error', 'Du har för många cyklar att sälja för den här handlaren!');
                }

                if ($user->bikes < $dealer->min_bikes) {
                    return Redirect::to('handlare')->with('error', 'Sorry! Men du är inte tillräckligt intressant för den här handlaren... (Du har för några cyklar)...');
                }

                $price = mt_rand($dealer->min_price, $dealer->max_price);
                $price = $user->getCalculatedPrice($price);

                $money = $user->bikes * $price; 

                $nr_of_bikes = $user->bikes;

                $user->bikes = 0;
                $user->money += $money;

                $experience = ($experience_per_bike * $nr_of_bikes);
                $experience = $user->addExp($experience);

                $user->save();

                return Redirect::to('handlare')->with('success', 'Du sålde ' . $nr_of_bikes . ' cyklar för ' . $money . ' kronor och '. $experience .' erfarenhetspoäng! ');
            } catch (Exception $e) {
                return Redirect::to('handlare')->with('error', 'Hörredudu, försök inte fuska!');
            }
        }
    }
}