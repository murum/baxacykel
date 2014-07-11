<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('attribute_id')->unsigned();
			$table->string('name');
			$table->integer('cooldown')->unsigned()->default(3600);
			$table->smallInteger('experience')->unsigned();
			$table->tinyInteger('min_point')->unsigned()->default(1);
			$table->tinyInteger('max_point')->unsigned()->default(2);

			$table->foreign('attribute_id')
				->references('id')->on('attributes')
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
		Schema::drop('courses');
	}

}
