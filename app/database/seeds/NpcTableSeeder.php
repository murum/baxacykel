<?php

class NpcTableSeeder extends Seeder {

    public function run()
    {
        DB::table('npc')->delete();

        $data = array(
            array(
                'name' => 'Tant Kerstin',
                'min' => 1,
                'max' => 2,
                'cooldown' => 20,
                'required_level' => 1,
            ),
            array(
                'name' => 'Polski Cykelverkstad',
                'min' => 2,
                'max' => 4,
                'cooldown' => 25,
                'required_level' => 2,
            ),
            array(
                'name' => 'Hyrcyklar i Klofen',
                'min' => 3,
                'max' => 8,
                'cooldown' => 25,
                'required_level' => 4,
            ),
            array(
                'name' => 'MTB Shoppen',
                'min' => 6,
                'max' => 12,
                'cooldown' => 25,
                'required_level' => 6,
            ),
            array(
                'name' => 'Cadium Drottningenssväng',
                'min' => 9,
                'max' => 17,
                'cooldown' => 30,
                'required_level' => 8,
            ),
            array(
                'name' => 'Kvarterets Mästare',
                'min' => 13,
                'max' => 23,
                'cooldown' => 35,
                'required_level' => 12,
            ),
            array(
                'name' => 'Gunvalds cykelförråd',
                'min' => 18,
                'max' => 30,
                'cooldown' => 40,
                'required_level' => 16,
            ),
            array(
                'name' => 'Nattklubben Foxlot',
                'min' => 28,
                'max' => 43,
                'cooldown' => 40,
                'required_level' => 20,
            ),
            array(
                'name' => 'Cykelklubben Bikers',
                'min' => 35,
                'max' => 48,
                'cooldown' => 45,
                'required_level' => 26,
            ),
            array(
                'name' => 'ICAS parkering',
                'min' => 44,
                'max' => 60,
                'cooldown' => 50,
                'required_level' => 32,
            ),
            array(
                'name' => 'Sportcykelhuset',
                'min' => 55,
                'max' => 76,
                'cooldown' => 50,
                'required_level' => 40,
            ),
            array(
                'name' => 'Röda grundskolan',
                'min' => 65,
                'max' => 88,
                'cooldown' => 55,
                'required_level' => 48,
            ),
            array(
                'name' => 'Lilla gymnasieskolan',
                'min' => 80,
                'max' => 105,
                'cooldown' => 60,
                'required_level' => 57,
            ),
            array(
                'name' => 'Stora gymnasieskolan',
                'min' => 100,
                'max' => 135,
                'cooldown' => 60,
                'required_level' => 67,
            ),
            array(
                'name' => 'Universitetet',
                'min' => 130,
                'max' => 160,
                'cooldown' => 60,
                'required_level' => 77,
            ),
            array(
                'name' => 'Småbåtshamnen',
                'min' => 160,
                'max' => 200,
                'cooldown' => 60,
                'required_level' => 90,
            ),
            array(
                'name' => 'Polisens hittegods',
                'min' => 215,
                'max' => 260,
                'cooldown' => 60,
                'required_level' => 105,
            ),
            array(
                'name' => 'Hamnterminal 3',
                'min' => 250,
                'max' => 305,
                'cooldown' => 60,
                'required_level' => 120,
            ),
            array(
                'name' => 'Flygplatsen',
                'min' => 300,
                'max' => 380,
                'cooldown' => 60,
                'required_level' => 140,
            ),
            array(
                'name' => 'Anderssons cykelfabrik',
                'min' => 350,
                'max' => 450,
                'cooldown' => 60,
                'required_level' => 160,
            ),
             array(
                'name' => 'Militärens förråd',
                'min' => 500,
                'max' => 625,
                'cooldown' => 65,
                'required_level' => 185,
            ),
              array(
                'name' => 'Citygross gömda cykelfabrik',
                'min' => 625,
                'max' => 750,
                'cooldown' => 65,
                'required_level' => 210,
            ),
            array(
                'name' => 'Vätternrundan',
                'min' => 750,
                'max' => 900,
                'cooldown' => 65,
                'required_level' => 245,
            ),
            array(
                'name' => 'Crechento Imports',
                'min' => 850,
                'max' => 1000,
                'cooldown' => 65,
                'required_level' => 280,
            ),
            array(
                'name' => 'Crechento Imports SR',
                'min' => 950,
                'max' => 1150,
                'cooldown' => 65,
                'required_level' => 315,
            ),
            array(
                'name' => 'Flygplats mellanlandningen',
                'min' => 1050,
                'max' => 1250,
                'cooldown' => 65,
                'required_level' => 350,
            ),
            array(
                'name' => 'Giro di italia',
                'min' => 1150,
                'max' => 1400,
                'cooldown' => 65,
                'required_level' => 395,
            ),
            array(
                'name' => 'Tour de france',
                'min' => 1250,
                'max' => 1650,
                'cooldown' => 65,
                'required_level' => 445,
            ),
            array(
                'name' => 'Fotbolls-VM cykelparkering',
                'min' => 1550,
                'max' => 2050,
                'cooldown' => 65,
                'required_level' => 500,
            ),
            array(
                'name' => 'OS-parken parkeringen',
                'min' => 1950,
                'max' => 2450,
                'cooldown' => 65,
                'required_level' => 550,
            ),
            array(
                'name' => 'Gunnars egna bondegård',
                'min' => 2500,
                'max' => 3250,
                'cooldown' => 70,
                'required_level' => 600,
            ),
            array(
                'name' => 'Cykelmästaren',
                'min' => 3500,
                'max' => 4250,
                'cooldown' => 75,
                'required_level' => 700,
            ),
            array(
                'name' => 'Världens Cykelkalas',
                'min' => 4000,
                'max' => 5000,
                'cooldown' => 70,
                'required_level' => 850,
            ),
            array(
                'name' => 'Zlatans reklamcyklar',
                'min' => 5500,
                'max' => 6500,
                'cooldown' => 75,
                'required_level' => 1050,
            ),
            array(
                'name' => 'Monarks lager',
                'min' => 7000,
                'max' => 8500,
                'cooldown' => 70,
                'required_level' => 1350,
            ),
            array(
                'name' => 'PEAK Fabriken',
                'min' => 8500,
                'max' => 10000,
                'cooldown' => 75,
                'required_level' => 1700,
            ),
            array(
                'name' => 'Cykelnät över indien',
                'min' => 17500,
                'max' => 22000,
                'cooldown' => 85,
                'required_level' => 2550,
            ),
            array(
                'name' => 'Transsibiriska järnvägen',
                'min' => 25000,
                'max' => 40000,
                'cooldown' => 100,
                'required_level' => 3550,
            ),




        );

        DB::table('npc')->insert($data);
    }

}