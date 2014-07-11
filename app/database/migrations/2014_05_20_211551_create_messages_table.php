<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sender')->unsigned();
			$table->integer('reciever')->unsigned();
			$table->string('title');
			$table->text('message');
			$table->boolean('read')->default(false);
			$table->timestamps();

			$table->foreign('sender')
				->references('id')->on('users')
				->onDelete('cascade');

			$table->foreign('reciever')
				->references('id')->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}
