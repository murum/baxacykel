<?php

class FactoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('factories')->delete();

        $data = array();
        foreach (Item::all() as $item) {
        	$data[] = array(
                'name' => $item->name . ' fabrik',
                'description' => 'Fabrik som tillverkar '. $item->name,
    			'item_id' => $item->id,
    		);
        }

        DB::table('factories')->insert($data);
    }

}