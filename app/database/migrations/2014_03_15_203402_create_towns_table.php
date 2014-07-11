<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('towns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('club_id')->unsigned()->nullable()->default(null);
			$table->string('name', 100);
			$table->text('description');
			$table->bigInteger('price')->default(100000000);
			$table->integer('auction_leader_club')->unsigned()->nullable()->default(null);
			$table->dateTime('ownership_end');
			$table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
			$table->foreign('auction_leader_club')->references('id')->on('clubs')->onDelete('cascade');
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
		Schema::drop('towns');
	}

}
