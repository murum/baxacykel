<?php

class CourseTableSeeder extends Seeder {

    public function run()
    {
        DB::table('courses')->delete();

        $data = array(
            array(
                'attribute_id' => 1,
                'name' => 'Håltimme med plugg',
                'min_point' => 3,
                'max_point' => 6,
                'cooldown' => 3600,
                'experience' => 200
            ),
            array(
                'attribute_id' => 1,
                'name' => 'Effektiv Mattekurs med Marita',
                'min_point' => 5,
                'max_point' => 10,
                'cooldown' => 10800,
                'experience' => 900
            ),
            array(
                'attribute_id' => 1,
                'name' => 'Nattkurs med Jaromir',
                'min_point' => 10,
                'max_point' => 30,
                'cooldown' => 25200,
                'experience' => 2250
            ),
            array(
                'attribute_id' => 2,
                'name' => 'Stretching',
                'min_point' => 3,
                'max_point' => 6,
                'cooldown' => 3600,
                'experience' => 200
            ),
            array(
                'attribute_id' => 2,
                'name' => 'Sprinterkurs med Usain Bolt',
                'min_point' => 4,
                'max_point' => 8,
                'cooldown' => 5400,
                'experience' => 450
            ),
            array(
                'attribute_id' => 2,
                'name' => 'En natt med aktiva mardrömmar',
                'min_point' => 10,
                'max_point' => 30,
                'cooldown' => 25200,
                'experience' => 2250
            ),
        );

        DB::table('courses')->insert($data);
    }

}