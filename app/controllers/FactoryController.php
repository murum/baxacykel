<?php

class FactoryController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function postActivateFactory() {
        $max_activated_factories = 6;

        try {
            $user = Auth::user();
            $factory_user_id = Input::get('factory_user');
            $factory_user = FactoryUser::findOrFail($factory_user_id);

            // If someone try to hack and activate for someone else
            if($factory_user->user_id != $user->id) {
                $message = 'Du kan ej aktivera en fabrik som inte är din egna';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            if($user->getActiveFactoriesCount() == $max_activated_factories) {
                $message = 'Du har redan max antal aktiva fabriker, vänligen avaktivera någon för att starta upp en ny.';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('warning', $message);
            }

            // If the users hasn't money enough to activate the factory
            if($user->money < $factory_user->getActivatePrice()) {
                $message = 'Du hade inte råd att aktivera den här fabriken.';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            // Remove money from the user
            $user->money -= $factory_user->getActivatePrice();
            $user->save();

            $now = new DateTime();

            $factory_user->active = true;
            $factory_user->activated = $now->format('Y-m-d H:i:s');
            $factory_user->save();

            $message = 'Du aktiverade fabriken '.$factory_user->factory->name.'!';
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('success', $message);

        } catch (Exception $e) {
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', 'Du försökte dig på att aktivera en fabrik som ej existerar');
        }
    }

    public function postInactivateFactory() {        
        try {
            $user = Auth::user();
            $factory_user_id = Input::get('factory_user');
            $factory_user = FactoryUser::findOrFail($factory_user_id);

            // If someone try to hack and activate for someone else
            if($factory_user->user_id != $user->id) {
                $message = 'Du kan inte inaktivera en fabrik som inte är din egen';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            if( $factory_user->deliveryItems() ) {
                $factory_user->active = false;
                $factory_user->activated = null;
                $factory_user->latest_delivery = null;
                $factory_user->save();

                $message = 'Du inaktiverade fabriken '.$factory_user->factory->name.'!';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('success', $message);
            } else {
                $message = 'Någonting gick fel vid inaktiveringen av fabriken, vänligen försök igen!';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

        } catch (Exception $e) {
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', 'Du försökte dig på att inaktivera en fabrik som ej existerar');
        }
    }

    public function postDeliveryFactory() {        
        try {
            $user = Auth::user();
            $factory_user_id = Input::get('factory_user');
            $factory_user = FactoryUser::findOrFail($factory_user_id);

            // If someone try to hack and activate for someone else
            if($factory_user->user_id != $user->id) {
                $message = 'Du kan inte tömma en fabrik som inte är din egen';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            $now = new DateTime();

            if( $factory_user->deliveryItems() ) {
                $factory_user->latest_delivery = $now->format('Y-m-d H:i:s');
                $factory_user->save();

                $message = 'Du tömde fabriken '.$factory_user->factory->name.' på varor!';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('success', $message);
            } else {
                $message = 'Någonting gick fel vid tömningen av fabriken, vänligen försök igen!';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

        } catch (Exception $e) {
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', 'Du försökte dig på att tömma en fabrik som ej existerar');
        }
    }

    public function postUpgradeFactory() {        
        try {
            $user = Auth::user();
            $factory_user_id = Input::get('factory_user');
            $factory_user = FactoryUser::findOrFail($factory_user_id);

            // If someone try to hack and activate for someone else
            if($factory_user->user_id != $user->id) {
                $message = 'Du kan inte uppgradera en fabrik som inte är din egen';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            if( $user->money < $factory_user->getUpgradePrice() ) {
                $message = 'Du har ej råd att uppgradera den här fabriken!';
                return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
            }

            // Deliver all items when upgrading.
            if( $factory_user->deliveryItems() ) {

                // Remove money from the user
                $user->money -= $factory_user->getUpgradePrice();
                if( $user->save() ) {
                    $now = new DateTime;
                    $factory_user->latest_delivery = $now->format('Y-m-d H:i:s');
                    $factory_user->upgrade += 1;

                    $factory_user->save();

                    $message = 'Du uppgraderade fabriken '.$factory_user->factory->name.' och samtidigt tömdes fabriken på varor, du hittar dessa varor i ditt lager!';
                    return Redirect::to('/mitt-kvarter#quarter-factories')->with('success', $message);
                } else {
                    $message = 'Oväntat fel inträffade när fabriken skulle tömmas!';
                    return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);
                }
            }

            $message = 'Oväntat fel inträffade när fabriken skulle tömmas!';
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', $message);

        } catch (Exception $e) {
            return Redirect::to('/mitt-kvarter#quarter-factories')->with('error', 'Du försökte dig på att tömma en fabrik som ej existerar');
        }
    }

}