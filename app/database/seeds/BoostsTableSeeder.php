<?php

class BoostsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('boosts')->delete();

/*
            $table->increments('id');
            $table->string('name');
            $table->integer('type')->unsigned();
            $table->integer('pedals')->unsigned();
            $table->timestamps();
            */
        $data = array(
            array(
                'name' => 'Minska väntetid 25% 1 dag',
                'type' => 1,
                'pedals' => 5,
                'length' => 86400,
            ),
            array(
                'name' => 'Minska väntetid 25% 1 vecka',
                'type' => 1,
                'pedals' => 25,
                'length' => 604800,
            ),
            array(
                'name' => 'Minska väntetid 25% 1 runda',
                'type' => 1,
                'pedals' => 50,
                'length' => null,
            ),
            array(
                'name' => 'Öka försäljningspriset med 50% 1 dag',
                'type' => 2,
                'pedals' => 5,
                'length' => 86400,
            ),
            array(
                'name' => 'Öka försäljningspriset med 50% 1 vecka',
                'type' => 2,
                'pedals' => 25,
                'length' => 604800,
            ),
            array(
                'name' => 'Öka försäljningspriset med 50% 1 runda',
                'type' => 2,
                'pedals' => 50,
                'length' => null,
            ),
            array(
                'name' => 'Få 50% mer experience på allt i 1 dag',
                'type' => 3,
                'pedals' => 5,
                'length' => 86400,
            ),
            array(
                'name' => 'Få 50% mer experience på allt i 1 vecka',
                'type' => 3,
                'pedals' => 25,
                'length' => 604800,
            ),
            array(
                'name' => 'Få 50% mer experience på allt i 1 runda',
                'type' => 3,
                'pedals' => 50,
                'length' => null,
            ),
        );

        DB::table('boosts')->insert($data);
    }

}