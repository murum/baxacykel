<?php

class AttributeUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('attribute_user')->delete();

        $data = array(
            array(
                'user_id' => 1,
                'attribute_id' => 1,
                'point' => 1,
            ),
            array(
                'user_id' => 1,
                'attribute_id' => 2,
                'point' => 1,
            )
        );

        DB::table('attribute_user')->insert($data);
    }

}