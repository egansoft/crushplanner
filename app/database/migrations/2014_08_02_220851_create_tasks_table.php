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
			$table->integer('user_id')->unsigned();
			$table->string('description');
			$table->integer('duration'); // in minutes
			$table->integer('sub_of');
			$table->dateTime('due_date');
			$table->integer('due_time'); // enum
			$table->dateTime('assigned_day');
			$table->integer('assigned_time'); // enum
			$table->boolean('done');
			$table->timestamps();
			
			$table->foreign('plan_id')->references('id')->on('plans');
			$table->foreign('user_id')->references('id')->on('users');
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
