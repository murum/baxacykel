<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNpcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('npc', function($table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('min')->unsigned();
			$table->integer('max')->unsigned();
			$table->integer('cooldown')->unsigned();
			$table->integer('required_level')->unsigned()->default(1);
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
		Schema::drop('npc');
	}

}
