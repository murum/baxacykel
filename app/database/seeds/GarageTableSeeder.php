<?php

class GarageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('garages')->delete();

        $data = array(
            array(
                'name' => 'Farsans garage',
                'size' => 5,
                'price' => 0,
            ),
            array(
                'name' => 'Skolans cykelställ',
                'size' => 10,
                'price' => 20000,
            ),
            array(
                'name' => 'Idrottshallens gömda källare',
                'size' => 30,
                'price' => 75000,
            ),
            array(
                'name' => 'Morfars gömda lagerlokal',
                'size' =>  50,
                'price' => 350000,
            ),
            array(
                'name' => 'E4ans dike',
                'size' => 100,
                'price' => 1000000,
            ),
            array(
                'name' => 'Googles Parkering',
                'size' => 200,
                'price' => 3500000,
            ),
            array(
                'name' => 'Fotbollsplanen',
                'size' => 500,
                'price' => 6000000,
            ),
            array(
                'name' => 'Neverland',
                'size' => 1750,
                'price' => 20000000,
            ),
            array(
                'name' => 'Eiffeltornet',
                'size' => 5000,
                'price' => 75000000,
            ),
            array(
                'name' => 'SkyDome',
                'size' => 10000,
                'price' => 300000000,
            ),
            array(
                'name' => 'Månen',
                'size' => 15000,
                'price' => 550000000,
            ),
            array(
                'name' => 'Mormor agdas bondgård',
                'size' => 50000,
                'price' => 1500000000,
            ),
            array(
                'name' => 'Vinerförvaring ABs Förvaring',
                'size' => 75000,
                'price' => 3000000000,
            ),
            array(
                'name' => 'Ekologiska KB ladugård',
                'size' => 125000,
                'price' => 5000000000,
            ),
            array(
                'name' => 'Olgas Hästfarm AB',
                'size' => 225000,
                'price' => 7500000000,
            ),
            array(
                'name' => 'Voffspalatset',
                'size' => 450000,
                'price' => 20000000000,
            ),
            array(
                'name' => 'Ekkes place',
                'size' => 1000000,
                'price' => 100000000000,
            ),

        );

        DB::table('garages')->insert($data);
    }

}