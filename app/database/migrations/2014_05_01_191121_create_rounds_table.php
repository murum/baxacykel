<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rounds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('is_reseted')->default(false);
			$table->string('name');
			$table->dateTime('start');
			$table->dateTime('end');
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
		Schema::drop('rounds');
	}

}
