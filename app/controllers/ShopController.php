<?php

class ShopController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getShop() {
        $agility_boosts = Boost::where('type', '=', 1)->get();
        $intelligence_boosts = Boost::where('type', '=', 2)->get();
        $experience_boosts = Boost::where('type', '=', 3)->get();
        $this->layout->content = View::make('shop.index')
            ->with('agility_boosts', $agility_boosts)
            ->with('intelligence_boosts', $intelligence_boosts)
            ->with('experience_boosts', $experience_boosts);
    }

    public function postShop() {

        if (Input::has('boost_id')) {

            $boost = Boost::find(Input::get('boost_id'));

            $user = Auth::user();

            $finished = new DateTime();
            if($boost->length > 0) {
                $finished->modify('+ ' . $boost->length . ' seconds');
            } else {
                $finished->modify('+365 days');
            }

            if ($user->pedals >= $boost->pedals) {

                $user->boosts()->attach($boost->id, array('finished' => $finished));

                $user->pedals -= $boost->pedals;
                $user->save();


                return Redirect::to('pedalshop')->with('success', 'Boosted!! Detta kostade dig ' . $boost->pedals . ' pedaler!');

            }

            return Redirect::to('pedalshop')->with('error', 'Du har inte tillräckligt med pedaler!');

        }


        if (Input::has('removeCooldown')) {

            $user = Auth::user();

            if ($user->pedals >= 3) {
                $user->pedals -= 3;
                $user->cooldown = 0;
                $user->save();

                return Redirect::to('pedalshop')->with('success', 'Din cooldown är nu borttagen. Detta kostade dig 3 pedaler.');

            }

            return Redirect::to('pedalshop')->with('error', 'Du har inte tillräckligt med pedaler!');

        }

        return Response::json(array(
            'success' => true, 
            'status' => 'success', 
            'message' => 'Du köpte boosten',
        ));
    }

}