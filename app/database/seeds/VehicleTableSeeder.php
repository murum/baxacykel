<?php

class VehicleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('vehicles')->delete();

        $data = array(
            array(
                'name' => 'Cykelkärra',
                'speed' => 5,
                'size' => 500,
                'price' => 0,
                'required_level' => 0,
            ),
            array(
                'name' => 'Flakmoped',
                'speed' => 15,
                'size' => 1000,
                'price' => 15000,
                'required_level' => 3,
            ),
            array(
                'name' => 'A-traktor',
                'speed' => 20,
                'size' => 2000,
                'price' => 25000,
                'required_level' => 4,
            ),
            array(
                'name' => 'Kiat Muppo',
                'speed' => 45,
                'size' => 4000,
                'price' => 45000,
                'required_level' => 6,
            ),
            array(
                'name' => 'Tia Kicanto',
                'speed' => 65,
                'size' => 6500,
                'price' => 75000,
                'required_level' => 9,
            ),
            array(
                'name' => 'Seanult Caster',
                'speed' => 65,
                'size' => 10000,
                'price' => 275000,
                'required_level' => 12,
            ),
            array(
                'name' => 'Tuskon',
                'speed' => 75,
                'size' => 20000,
                'price' => 705000,
                'required_level' => 18,
            ),
            array(
                'name' => 'Tanker',
                'speed' => 75,
                'size' => 30000,
                'price' => 1500000,
                'required_level' => 23,
            ),
            array(
                'name' => 'Stora Tanky',
                'speed' => 75,
                'size' => 70000,
                'price' => 7500000,
                'required_level' => 33,
            ),
            array(
                'name' => 'Långa Amerikanen',
                'speed' => 75,
                'size' => 110000,
                'price' => 25000000,
                'required_level' => 44,
            ),
            array(
                'name' => 'Planie',
                'speed' => 100,
                'size' => 280000,
                'price' => 100000000,
                'required_level' => 52,
            ),
            array(
                'name' => 'Fasty Tonzalez',
                'speed' => 125,
                'size' => 380000,
                'price' => 300000000,
                'required_level' => 67,
            ),
            array(
                'name' => 'Daddy Tonzalez',
                'speed' => 135,
                'size' => 900000,
                'price' => 1000000000,
                'required_level' => 87,
            ),
            array(
                'name' => 'Foxxen',
                'speed' => 135,
                'size' => 1500000,
                'price' => 3000000000,
                'required_level' => 107,
            ),
            array(
                'name' => 'Ballzorker',
                'speed' => 145,
                'size' => 2000000,
                'price' => 5000000000,
                'required_level' => 137,
            ),
            array(
                'name' => 'Zlowy',
                'speed' => 115,
                'size' => 3000000,
                'price' => 10000000000,
                'required_level' => 187,
            ),
            array(
                'name' => 'Speedy Two',
                'speed' => 175,
                'size' => 3500000,
                'price' => 15000000000,
                'required_level' => 237,
            ),
            array(
                'name' => 'Mingo',
                'speed' => 135,
                'size' => 4200000,
                'price' => 30000000000,
                'required_level' => 337,
            ),
            array(
                'name' => 'Rocket Ztar',
                'speed' => 155,
                'size' => 5200000,
                'price' => 50000000000,
                'required_level' => 400,
            ),
            array(
                'name' => 'Plutorim',
                'speed' => 135,
                'size' => 6500000,
                'price' => 80000000000,
                'required_level' => 497,
            ),
            array(
                'name' => 'Septorian',
                'speed' => 195,
                'size' => 8500000,
                'price' => 100000000000,
                'required_level' => 580,
            ),
            array(
                'name' => 'Segon',
                'speed' => 85,
                'size' => 12000000,
                'price' => 300000000000,
                'required_level' => 727,
            ),
            array(
                'name' => 'Frenchis',
                'speed' => 125,
                'size' => 20000000,
                'price' => 700000000000,
                'required_level' => 1027,
            ),
            array(
                'name' => 'Karlkoz',
                'speed' => 125,
                'size' => 30000000,
                'price' => 1000000000000,
                'required_level' => 1327,
            ),
            array(
                'name' => 'Ingos Master',
                'speed' => 205,
                'size' => 60000000,
                'price' => 3000000000000,
                'required_level' => 1827,
            ),
            array(
                'name' => 'Bronzie Bird',
                'speed' => 255,
                'size' => 90000000,
                'price' => 7000000000000,
                'required_level' => 3327,
            ),
            array(
                'name' => 'Silver bullet',
                'speed' => 255,
                'size' => 140000000,
                'price' => 15000000000000,
                'required_level' => 4527,
            ),
            array(
                'name' => 'Golden Gorillaz',
                'speed' => 155,
                'size' => 200000000,
                'price' => 45000000000000,
                'required_level' => 6027,
            ),
            array(
                'name' => 'Platinum Santa',
                'speed' => 275,
                'size' => 400000000,
                'price' => 75000000000000,
                'required_level' => 9027,
            ),


        );

        DB::table('vehicles')->insert($data);
    }

}