<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function(Blueprint $table) {
			$table->increments('id');
			$table->text('title',256);
			$table->string('hash',1024);
			$table->integer('subjectid')->unsigned()->references('id')->on('subjects');
			$table->integer('createdby')->unsigned()->references('id')->on('users');
			$table->integer('totalquestions')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exams');
	}

}
