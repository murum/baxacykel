<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoryUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factory_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('factory_id')->unsigned();
			$table->dateTime('latest_delivery')->nullable()->default(null);
			$table->smallInteger('upgrade')->default(1);
			$table->dateTime('activated')->nullable()->default(null);
			$table->boolean('active')->default(false);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('factory_id')->references('id')->on('factories')->onDelete('cascade');
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
		Schema::drop('factory_user');
	}

}
