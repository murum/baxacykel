<?php

class ItemMarketTableSeeder extends Seeder {

    public function run()
    {
        DB::table('item_market')->delete();

        $data = array();

        foreach (Market::all() as $market) {
            foreach (Item::all() as $item) {
            	$data[] = array(
        			'market_id' => $market->id,
        			'item_id' => $item->id,
        			'price' => (int)mt_rand($item->min_price, $item->max_price),
        			'amount' => 10000,
        		);

            }
        }

        DB::table('item_market')->insert($data);
    }

}