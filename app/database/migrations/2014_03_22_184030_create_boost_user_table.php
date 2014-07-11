<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoostUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boost_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('boost_id')->unsigned();
			$table->timestamp('finished');
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
							$table->foreign('boost_id')
				->references('id')->on('boosts')
				->onDelete('cascade');
	
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
		Schema::drop('boost_user');
	}

}
