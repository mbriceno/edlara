<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeacherTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function(Blueprint $table) {
            
            //Creating UserID Colomn && Making Foreign Key reference to UserID
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                                    
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
        DB::statement('ALTER TABLE `teachers` MODIFY `extra` LONGTEXT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teachers');
    }

}
