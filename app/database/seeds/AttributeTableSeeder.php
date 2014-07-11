<?php

class AttributeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('attributes')->delete();

        $data = array(
            array(
                'name' => 'Intelligens',
                'max_value' => 200,
                'description' => 'För varje intelligens poäng så ökar du försäljnigspriset med 1%, maximalt 200 poäng',
            ),
            array(
                'name' => 'Rörlighet',
                'max_value' => 80,
                'description' => 'För varje agility poäng så minskar du väntetiden med 0.5%, maximalt 80 poäng.',
            ),
        );

        DB::table('attributes')->insert($data);
    }

}