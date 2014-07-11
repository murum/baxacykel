<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('round_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('round_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('money')->default(null)->nullable();
			$table->string('experience')->default(null)->nullable();
			$table->string('level')->default(null)->nullable();
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
		Schema::drop('round_user');
	}

}
