<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
		   
            //Creating UserID Colomn
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                        
            //Creating Colomn username. Setting it as unique
            $table->string('username',32)->unique()->foreign('username')->references('username')->on('users')->onDelete('cascade');
            
            //Creating Colomn email. Setting it as unique.
            $table->string('email',64)->unique()->foreign('email')->references('email')->on('users')->onDelete('cascade');
            
            //Creating Colomn DateOfBith.Setting it as unique.
            $table->date('dob');
            
            //Creating Colomn subjects
            $table->text('extra');
            
            //Adding Timestamps to Track editing of Profile
            $table->timestamps();
        
        });
        
        //Setting extra data to LongText to allow much data to be put in
        DB::statement('ALTER TABLE `students` MODIFY `extra` LONGTEXT;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('students');		
	}

}