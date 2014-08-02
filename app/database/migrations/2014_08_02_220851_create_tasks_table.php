<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($table) {
			$table->increments('id');
			$table->integer('plan_id')->unsigned();
			$table->string('description');
			$table->integer('duration'); // in minutes
			$table->integer('sub_of')->unsigned();
			$table->dateTime('due');
			$table->date('assigned_day');
			$table->integer('assigned_time'); // enum
			$table->boolean('done');
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
		Schema::drop('tasks');
	}

}
