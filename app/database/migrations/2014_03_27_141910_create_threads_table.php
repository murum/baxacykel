<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('title');
			$table->text('content');
			$table->foreign('category_id')
				->references('id')->on('categories')
				->onDelete('cascade');
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
			$table->timestamp('last_post');
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
		Schema::drop('threads');
	}

}
