<?php

class ItemTableSeeder extends Seeder {

    public function run()
    {
        DB::table('items')->delete();

        $data = array(
            array(
                'name' => 'Styre',
                'evolve_time' => '40',
                'min_price' => 65,
                'max_price' => 75,
            ),
            array(
                'name' => 'Kedja',
                'evolve_time' => '45',
                'min_price' => 40,
                'max_price' => 63,
            ),
            array(
                'name' => 'Växelsystem',
                'evolve_time' => '40',
                'min_price' => 40,
                'max_price' => 55,
            ),
            array(
                'name' => 'Eker',
                'evolve_time' => '7',
                'min_price' => 8,
                'max_price' => 14,
            ),
            array(
                'name' => 'Däck',
                'evolve_time' => '60',
                'min_price' => 53,
                'max_price' => 76,
            ),
            array(
                'name' => 'Ram',
                'evolve_time' => '90',
                'min_price' => 120,
                'max_price' => 150,
            ),
            array(
                'name' => 'Cykeldator',
                'evolve_time' => '45',
                'min_price' => 55,
                'max_price' => 70,
            ),
            array(
                'name' => 'Pump',
                'evolve_time' => '15',
                'min_price' => 12,
                'max_price' => 25,
            ),
            array(
                'name' => 'Stödhjul',
                'evolve_time' => '28',
                'min_price' => 25,
                'max_price' => 34,
            ),
        );

/* 

            array(
                'name' => 'Skärm',
                'evolve_time' => '20',
                'min_price' => 15,
                'max_price' => 25,
            ),

            array(
                'name' => 'Sadel',
                'evolve_time' => '30',
                'min_price' => 30,
                'max_price' => 45,
            ),

            array(
                'name' => 'Ringklocka',
                'evolve_time' => '11',
                'min_price' => 10,
                'max_price' => 18,
            ),
            array(
                'name' => 'Cykelkärra',
                'evolve_time' => '90',
                'min_price' => 100,
                'max_price' => 125,
            ),

            array(
                'name' => 'Hjälm',
                'evolve_time' => '35',
                'min_price' => 35,
                'max_price' => 55,
            ),
            array(
                'name' => 'Lås',
                'evolve_time' => '60',
                'min_price' => 45,
                'max_price' => 58,
            ),
*/

        DB::table('items')->insert($data);
    }

}