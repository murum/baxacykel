<?php

class MarketTableSeeder extends Seeder {

    public function run()
    {
        DB::table('markets')->delete();

        $data = array();

        foreach (Town::all() as $town) {
            $data[] = array('town_id' => $town->id);
        }

        DB::table('markets')->insert($data);
    }

}