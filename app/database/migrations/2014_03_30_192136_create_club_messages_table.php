<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('club_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('message', 2048);
			$table->timestamps();
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
		Schema::drop('club_messages');
	}

}
