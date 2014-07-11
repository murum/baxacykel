<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('item_user')->delete();
        DB::table('factory_user')->delete();

        $data = array(
            array(
                'username' => 'admin',
                'password' => Hash::make('HelloWorld123'),
                'email' => 'admin@baxacykel.se',
                'money' => 0,
                'bikes' => 0,
                'garage_id' => 1,
                'town_id' => 1,
                'role_level' => 1,
            ),
        );


        DB::table('users')->insert($data);


        $counter = 0;
        foreach ($data as $user) {
            $counter++;

            $data_items = array();

            foreach (Item::all() as $item) {
                $data_items[] = array(
                    'user_id' => $counter,
                    'item_id' => $item->id,
                    'in_storage' => 5,
                    'in_vehicle' => 0,
                );
            }
            DB::table('item_user')->insert($data_items);
        }


        $counter = 0;
        foreach ($data as $user) {
            $counter++;

            $data_factories = array();

            foreach (Factory::all() as $factory) {
                $data_factories[] = array(
                    'user_id' => $counter,
                    'factory_id' => $factory->id,
                    'upgrade' => 0,
                );
            }
            DB::table('factory_user')->insert($data_factories);
        }
    }

}