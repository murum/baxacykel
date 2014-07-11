<?php

class RobController extends BaseController {

    protected $layout = 'templates.layout.master';
    
    public function getRobbing() {
        try {
            $coming_npc = Npc::findOrFail((int)(Npc::where('required_level', '<=', Auth::user()->getLevel())->get()->last()->id) + 1);
            
            $this->layout->content = View::make('rob.index')
                ->with('npcs', Npc::where('required_level', '<=', Auth::user()->getLevel())->orderBy('id', 'desc')->get())
                ->with('comingNpc', $coming_npc)
                ->with('cooldown', Auth::user()->getRemainingCooldown());

        } catch (Exception $e) {
            $this->layout->content = View::make('rob.index')
                ->with('npcs', Npc::where('required_level', '<=', Auth::user()->getLevel())->orderBy('id', 'desc')->get())
                ->with('comingNpc', null)
                ->with('cooldown', Auth::user()->getRemainingCooldown());
        }
    }

    public function postRobbing() {

        // If NPC exists
        if (Input::has('npc_id')) {
            try {
                // Fails if the given NPC doesn't exist
                $npc = Npc::findOrFail(Input::get('npc_id'));
        
                // Get current user
                $user = Auth::user();

                // Experience per bike
                $experience_per_bike = 4;

                // Initiate message variables
                $required_level = false;
                $has_cooldown = true;
                $full_garage = true;
                $got_jailed = false;
                $jail_seconds = 480;
                $lucky_rob_cooldown_reduce = false;
                $lucky_robber = false;
                $zero_bikes_by_npc = true;
                $garage_full_after_rob = true;

                $lucky_robber_percent = 10;
                $lucky_rob_cooldown_reduce_percent = 25;
                $jail_percent = 2;
                $minimum_jail_level = 10;


                /**
                 * POSSIBLE ERRORS
                 * 
                 * Required Level > Current level
                 * User has cooldown
                 * User has full garage
                 */                
                
                // If the required level is higher than users current level
                if ($user->getLevel() < $npc->required_level) {
                    $message = robbery_string_builder($required_level);

                    return Redirect::to('baxa')->with('warning', $message);
                } else {
                    $required_level = true;
                }


                // If the user has cooldown
                $current_date = new DateTime();
                if ($user->cooldown > $current_date->format('Y-m-d H:i:s')) {
                    Log::info(e($user->username) . ' försökte råna men hade cooldown!');

                    $message = robbery_string_builder($required_level, $has_cooldown);
                    return Redirect::to('baxa')->with('warning', $message);
                } else {
                    $has_cooldown = false;
                }

                // If the user has a full garage
                $garage = $user->garage;
                if ($garage->size <= $user->bikes) {
                    $message = robbery_string_builder($required_level, $has_cooldown, $full_garage);

                    return Redirect::to('baxa')->with('error', $message);
                } else {
                    $full_garage = false;
                }
                /**
                 * END OF POSSIBLE ERRORS
                 */



                // Set cooldown
                $cooldown = new DateTime();

                // Set the percentage of jail robberies
                $got_jailed = (mt_rand(0, 100) < $jail_percent) ? true : false;

                // Minimum lvl 10 to get jailed
                if($user->level <= $minimum_jail_level)
                {
                    $got_jailed = false;
                }

                // Set the percentage of cooldown reduced robberies
                $lucky_rob_cooldown_reduce = (mt_rand(0, 100) <= $lucky_rob_cooldown_reduce_percent) ? true : false;

                // If got jailed
                if($got_jailed) {
                    $cooldown->modify("+{$jail_seconds} seconds");
                    $user->cooldown = $cooldown;
                    $user->save();

                    $message = robbery_string_builder(
                        $required_level, 
                        $has_cooldown, 
                        $full_garage,
                        $got_jailed,
                        $jail_seconds
                    );

                    return Redirect::to('baxa')->with('error', $message);
                }

                if($lucky_rob_cooldown_reduce) {
                    $calculated_cooldown = (int)$user->getCalculatedCooldown(((int)$npc->cooldown / 2));
                    $cooldown->modify("+{$calculated_cooldown} seconds");
                } else {
                    $calculated_cooldown = (int)$user->getCalculatedCooldown($npc->cooldown);
                    $cooldown->modify("+{$calculated_cooldown} seconds");
                }




                // Set the bikes for this robbery
                $bikes = mt_rand($npc->min, $npc->max);

                // Set the percentage of lucky robberies
                $lucky_robber = (mt_rand(0, 100) <= $lucky_robber_percent) ? true : false;
                
                // If lucky rob multiply the max bike amount
                if($lucky_robber) {
                    $bikes = $npc->max;
                    $bikes *= 2;
                }


                Log::info(e($user->username) . ' robbed ' . $npc->name . ' and got ' . $bikes . ' bikes and got ~ ' . (8 * $bikes) . ' experience.');

                // If user fails the robbery and got 0 bikes
                $zero_bikes_by_npc = ($bikes == 0) ? true : false;
                if ($zero_bikes_by_npc) {
                    $message = robbery_string_builder(
                        $required_level, 
                        $has_cooldown, 
                        $full_garage,
                        $got_jailed,
                        $jail_seconds,
                        $zero_bikes_by_npc
                    );

                    $user->cooldown = $cooldown;

                    $user->save();
                    return Redirect::to('baxa')->with('error', $message);
                }

                // If garage will be full with the amount of robbed bikes
                if ($garage->size < ($user->bikes + $bikes)) {

                    // bikes to left to full garage
                    $amount_bikes = $bikes - (($user->bikes + $bikes) - $garage->size);
        
                    // Add experience to user
                    $experience_to_add = ($experience_per_bike * $amount_bikes);
                    $experience = $user->addExp($experience_to_add);

                    // Set Users new values
                    $user->cooldown = $cooldown;
                    $user->bikes += $amount_bikes;
                    // Save the user
                    if( $user->save() ) {
                        $message = robbery_string_builder(
                            $required_level, 
                            $has_cooldown, 
                            $full_garage,
                            $got_jailed,
                            $jail_seconds,
                            $zero_bikes_by_npc,
                            $lucky_rob_cooldown_reduce,
                            $lucky_robber,
                            $amount_bikes,
                            $experience,
                            $garage_full_after_rob
                        );

                        return Redirect::to('baxa')->with('success', $message);
                    } else {
                        return Redirect::to('baxa')->with('error', 'Ett oväntat fel inträffade.');
                    }
                } else {
                    $garage_full_after_rob = false;
                        // Add experience to user
                    $experience_to_add = ($experience_per_bike * $bikes);
                    $experience = $user->addExp($experience_to_add);

                    // Ser new user values
                    $user->cooldown = $cooldown;
                    $user->bikes += $bikes;

                    if( $user->save()) {
                        $message = robbery_string_builder(
                            $required_level, 
                            $has_cooldown, 
                            $full_garage,
                            $got_jailed,
                            $jail_seconds,
                            $zero_bikes_by_npc,
                            $lucky_rob_cooldown_reduce,
                            $lucky_robber,
                            $bikes,
                            $experience,
                            $garage_full_after_rob
                        );
                        return Redirect::to('baxa')->with('success', $message);
                    } else {
                        return Redirect::to('baxa')->with('error', 'Ett oväntat fel inträffade.');
                    }
                }

            } catch (Exception $e) {
                return Redirect::to('baxa')->with('error', $e->getMessage() . ': ' . $e->getLine());
            }
        }
    }
}