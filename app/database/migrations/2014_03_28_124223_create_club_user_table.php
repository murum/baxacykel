<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_user', function($table)
		{
			$table->increments('id');
			$table->integer('club_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->boolean('chat_read')->default(false);
			$table->boolean('approved')->default(false);
			$table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
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
		Schema::dropIfExists('club_user');
	}

}
