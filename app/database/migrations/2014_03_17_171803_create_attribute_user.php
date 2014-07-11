<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_user', function($table)
		{
			$table->increments('id');
			$table->integer('attribute_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('point')->unsigned()->default(0);
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_user');
	}

}
