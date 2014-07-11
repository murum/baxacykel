<?php

class TownTableSeeder extends Seeder {

    public function run()
    {
        DB::table('towns')->delete();

        $data = array(
            array(
                'name' => 'Old Jork',
                'description' => 'The city where the wolves first grow up',
                'ownership_end' => '0000-00-00 00:00:00',
            ),
            array(
                'name' => 'Uppercoll',
                'description' => 'Small village in the northern Canada where grizzly bears bax a few bikes in a day',
                'ownership_end' => '0000-00-00 00:00:00',
            ),
            array(
                'name' => 'Phettostan',
                'description' => 'A place where all people are phat',
                'ownership_end' => '0000-00-00 00:00:00',
            ),
            array(
                'name' => 'Tikoy',
                'description' => 'The town where everyone are nice and everybody go out and clean the streets on Sundays',
                'ownership_end' => '0000-00-00 00:00:00',
            ),
            array(
                'name' => 'Birne Island',
                'description' => 'A island close to the South Africa coast where everybody looks like gorillas',
                'ownership_end' => '0000-00-00 00:00:00',
            ),
        );

        DB::table('towns')->insert($data);
    }

}