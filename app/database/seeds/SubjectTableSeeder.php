<?php

class SubjectTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('subjects') -> delete();
    	Subject::create(array('subjectcode' => 'CM12',
    		'grade'=>'12','subjectname'=>'Combined Maths'));
    	Subject::create(array('subjectcode' => 'C12',
    		'grade'=>'12','subjectname'=>'Chemistry'));
    	Subject::create(array('subjectcode' => 'P12',
    		'grade'=>'12','subjectname'=>'Physics'));
    	Subject::create(array('subjectcode' => 'B12',
    		'grade'=>'12','subjectname'=>'Biology'));
    }

}