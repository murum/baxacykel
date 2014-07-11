<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('GarageTableSeeder');
		$this->call('TownTableSeeder');
		$this->call('MarketTableSeeder');
		$this->call('ItemTableSeeder');
		$this->call('ItemMarketTableSeeder');

		$this->call('FactoryTableSeeder');

		$this->call('VehicleTableSeeder');

        $this->call('UserTableSeeder');
		$this->call('NpcTableSeeder');
		$this->call('DealerTableSeeder');
		$this->call('AttributeTableSeeder');

		$this->call('AttributeUserTableSeeder');

		$this->call('CourseTableSeeder');

		$this->call('BoostsTableSeeder');

		$this->call('ChatMessageTableSeeder');
		
		$this->call('CategoryTableSeeder');
		$this->call('ThreadTableSeeder');


		$this->call('FaqTableSeeder');
	}

}