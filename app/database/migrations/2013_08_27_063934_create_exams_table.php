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
            $table->string('title', 64);
			$table->text('description', 255);
			$table->string('examtype', 64);
			$table->string('subjectcode', 64);
			$table->text('questions');
			$table->text('created_by', 255);
			$table->text('modified_by', 255);
            $table->timestamps();
        });
        //Setting extra data to LongText to allow much data to be put in
        DB::statement('ALTER TABLE `exams`  MODIFY `questions` LONGTEXT;');
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
