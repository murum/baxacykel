<?php

class CourseController extends BaseController {

    protected $layout = 'templates.layout.master';
    
    public function getCourse() {
        $user = Auth::user();

        $attributes = Attribute::all();
        $attributes_to_include = array();

        foreach ( $attributes as $attribute ) {

            if ( $user->getUserAttribute($attribute->id)->point != $attribute->max_value) {
                    $attributes_to_include[] = $attribute->id;
            }
        }

        if(count($attributes_to_include) > 0) {
            $courses = Course::whereIn('attribute_id', $attributes_to_include)->get();
        } else {
            $courses = array();
        }

        $this->layout->content = View::make('course.index')
            ->with('courses', $courses)
            ->with('cooldown', Auth::user()->getRemainingCooldown());
    }

    public function postCourse() {
        if(Auth::user()->level < 10) {
            return Redirect::to('skolan')->with('warning', 'Skolan öppnas så snart du är level 10!');
        }

        // Course id is given..
        if (Input::has('course_id')) {

            // Variables
            $course = Course::findOrFail(Input::get('course_id'));
            $user = Auth::user();
            $agility_max = Attribute::find(2)->max_value;
            $intelligence_max = Attribute::find(1)->max_value;
            $user_agility = $user->getAgility();
            $user_int = $user->getIntelligence();
            $experience = 0;

            // User has cooldown
            $date = new DateTime();
            if ($user->cooldown > $date->format('Y-m-d H:i:s')) {
                return Redirect::to('skolan')->with('warning', 'Du är redan upptagen, avvakta tills du är redo för att utföra ett nytt uppdrag!');
            }

            // Add points to user
            $points = mt_rand($course->min_point, $course->max_point);

            // Adding experience to user
            $experience += $course->experience;
            $experience = $user->addExp($experience);

            // If agility points is maxed
            if( $course->attribute_id == 2 && ($user_agility + $points) > $agility_max) {
                
                $user->setAttributePoints($course->attribute_id, $agility_max);

                $message = 'Du har nu maxat din rörlighet, du kan inte bli hur rörlig som helst min käre vän!';

            } else if($course->attribute_id == 1 && ($user_int + $points) > $intelligence_max)
            {
                $user->setAttributePoints($course->attribute_id, $intelligence_max);

                $message = 'Du har nu maxat din intelligens, du kan inte bli hur smart som helst min smarte vän!';

            } else {
                $user->addAttributePoints($course->attribute_id, $points);

                // If course gave the lower point possible
                if($points ==  $course->min_point) {
                    $message = '
                    Du hade en dålig dag och kunde ej koncentrera dig under kursen och tjänade endast ' . $points . ' poäng. 
                    Men för att du var duktig och gick till kursen fick du också ' . $experience . ' erfarenhetspoäng!';
                } 
                // If course gave the highest point possible
                else if ( $points == $course->max_point ) {
                    $message = '
                        Du skötte dig exemplariskt under kursen och tjänade hela ' . $points . ' poäng. 
                        Du skrapade därför ihop ' . $experience . ' erfarenhetspoäng vid sidan av dina skicklighetspoäng!';
                } 
                // If course gave the points which was not max or min for the course
                else {
                    $message = '
                        Du skötte dig hyffsat och fick med dig ' . $points . ' poäng i från kursen.
                        Erfarenhetspoäng tycker vi helt klart du ska få för denna prestation, grattis till ' . $experience . ' nya erfarenhetspoäng!';
                }
            }

            // Adding cooldown to user
            $cooldown = new DateTime();
            $calced_cooldown = (int)$user->getCalculatedCooldown($course->cooldown);
            $cooldown->modify("+{$calced_cooldown} seconds");
            $user->cooldown = $cooldown;

            // Save user
            $user->save();
            
            // Redirect user
            return Redirect::to('skolan')->with('success', $message);
        }
    }
}