<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTutorialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->text('description',);
            $table->string('alias',32);
            $table->text('subjectname')
            $table->string('subjectcode');
            $table->text('content');
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
        Schema::drop('tutorials');
    }

}
