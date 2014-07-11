<?php

class DealerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('dealers')->delete();

        $data = array(
            array(
                'name' => 'Cykel Kjell',
                'min_bikes' => 1,
                'max_bikes' => 4,
                'min_price' => 200,
                'max_price' => 450,
            ),
            array(
                'name' => 'Bikestore i Faksen',
                'min_bikes' => 4,
                'max_bikes' => 15,
                'min_price' => 350,
                'max_price' => 550,
            ),
            array(
                'name' => 'Ender Spårt',
                'min_bikes' => 15,
                'max_bikes' => 35,
                'min_price' => 400,
                'max_price' => 750,
            ),
            array(
                'name' => 'Hyrcykel Koteberg',
                'min_bikes' => 35,
                'max_bikes' => 65,
                'min_price' => 600,
                'max_price' => 875,
            ),
            array(
                'name' => 'Skåne Cykeltaxi',
                'min_bikes' => 65,
                'max_bikes' => 100,
                'min_price' => 775,
                'max_price' => 1100,
            ),
            array(
                'name' => 'Cykelkungen',
                'min_bikes' => 100,
                'max_bikes' => 175,
                'min_price' => 1000,
                'max_price' => 1400,
            ),
            array(
                'name' => 'Båthults cykelimport',
                'min_bikes' => 175,
                'max_bikes' => 350,
                'min_price' => 1200,
                'max_price' => 1700,
            ),
            array(
                'name' => 'Monarky Cykeldemontering',
                'min_bikes' => 350,
                'max_bikes' => 750,
                'min_price' => 1500,
                'max_price' => 2000,
            ),
            array(
                'name' => 'Montana enterprises',
                'min_bikes' => 750,
                'max_bikes' => 1500,
                'min_price' => 1900,
                'max_price' => 2500,
            ),
            array(
                'name' => 'Recycling',
                'min_bikes' => 1500,
                'max_bikes' => 5000,
                'min_price' => 2300,
                'max_price' => 3250,
            ),
            array(
                'name' => 'CCCP Shipping',
                'min_bikes' => 5000,
                'max_bikes' => 7500,
                'min_price' => 3000,
                'max_price' => 4250,
            ),
            array(
                'name' => 'US Bikeflight',
                'min_bikes' => 7000,
                'max_bikes' => 10000,
                'min_price' => 4000,
                'max_price' => 5450,
            ),
            array(
                'name' => 'Worldwide bike shoppers',
                'min_bikes' => 10000,
                'max_bikes' => 20000,
                'min_price' => 5250,
                'max_price' => 6950,
            ),
            array(
                'name' => 'Geospace Delivery',
                'min_bikes' => 20000,
                'max_bikes' => 40000,
                'min_price' => 6000,
                'max_price' => 8000,
            ),
            array(
                'name' => 'Måntransportören',
                'min_bikes' => 40000,
                'max_bikes' => 80000,
                'min_price' => 7000,
                'max_price' => 9000,
            ),
            array(
                'name' => 'Kuiperbältet AB',
                'min_bikes' => 80000,
                'max_bikes' => 120000,
                'min_price' => 8000,
                'max_price' => 9500,
            ),
            array(
                'name' => 'Oorts moln E-handel',
                'min_bikes' => 120000,
                'max_bikes' => 200000,
                'min_price' => 8750,
                'max_price' => 10000,
            ),
            array(
                'name' => 'Orion Invest',
                'min_bikes' => 200000,
                'max_bikes' => 450000,
                'min_price' => 9500,
                'max_price' => 11000,
            ),
            array(
                'name' => 'Vintergatan Campaign',
                'min_bikes' => 450000,
                'max_bikes' => 1000000,
                'min_price' => 10000,
                'max_price' => 12000,
            ),
        );

        DB::table('dealers')->insert($data);
    }

}