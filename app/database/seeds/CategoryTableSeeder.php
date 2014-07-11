<?php

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        $data = array(
            array(
                'title' => 'BaxaCykel.se',
            ),
        );

        DB::table('categories')->insert($data);
    }

}