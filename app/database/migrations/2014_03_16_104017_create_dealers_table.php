<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealers', function($table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('min_bikes')->unsigned();
			$table->integer('max_bikes')->unsigned();
			$table->integer('min_price')->unsigned();
			$table->integer('max_price')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dealers');
	}

}
