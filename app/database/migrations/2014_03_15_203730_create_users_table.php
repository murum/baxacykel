<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('remember_token', 100);
			$table->integer('garage_id')->unsigned()->default(1);
			$table->integer('vehicle_id')->unsigned()->default(1);
			$table->integer('town_id')->unsigned()->nullable()->default(null);
			$table->integer('current_town')->unsigned()->nullable()->default(null);
			$table->string('username', 20);
			$table->string('profile', 2048)->default('Den här personen har inte skrivit någonting om sig själv ännu...')->nullable();
			$table->string('password', 60);
			$table->string('email');
			$table->tinyInteger('noticed')->default(0);
			$table->tinyInteger('chat_noticed')->default(0);
			$table->bigInteger('money')->default(0);
			$table->integer('pedals')->default(0);
			$table->integer('role_level')->unsigned()->default(1);
			$table->integer('bikes')->unsigned()->default(0);
			$table->integer('level')->unsigned()->default(1);
			$table->integer('ref_user_id')->unsigned()->default(0);
			$table->integer('experience')->unsigned()->default(100);
			$table->timestamp('cooldown');
			$table->dateTime('last_login');
			$table->timestamps();
			$table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
			$table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
			$table->foreign('town_id')->references('id')->on('towns')->onDelete('cascade');
			$table->foreign('current_town')->references('id')->on('towns')->onDelete('cascade');
			$table->index('username');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
