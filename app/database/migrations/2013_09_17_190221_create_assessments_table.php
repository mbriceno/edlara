<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssessmentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
			$table->text('description', 255);
			$table->string('assessmenttype', 64);
            $table->integer('tutorialid');
            $table->integer('teacherid');
            $table->integer('studentid');
            $table->integer('subjectid');
            $table->text('groupstudentid');
			$table->text('attachments');
            $table->integer('marks');
            $table->text('result');
            $table->timestamps();                       
            $table->softDeletes();
        });
        //Setting extra data to LongText to allow much data to be put in
        DB::statement('ALTER TABLE `assessments`  MODIFY `attachments` LONGTEXT;');
        DB::statement('ALTER TABLE `assessments`  MODIFY `result` LONGTEXT;');
        DB::statement('ALTER TABLE `assessments`  MODIFY `groupstudentid` LONGTEXT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assessments');
    }

}
