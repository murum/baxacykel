<?php

class ThreadTableSeeder extends Seeder {

    public function run()
    {
        DB::table('threads')->delete();

        $data = array(
            array(
                'category_id' => 1,
                'user_id' => 2,
                'title' => 'BaxaCykel.se',
                'content' => 'Hello World!',
                'created_at' => '2014-03-27 15:12:00',
            ),
        );

        DB::table('threads')->insert($data);
    }

}