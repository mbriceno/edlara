<?php

class StudentTableSeeder extends Seeder {
    public function run() {

        DB::table('students') -> delete();        
        $extra = array('subjects'=>array('1','2','3','4'));
        $extra = serialize($extra);
        Student::create(array('user_id' => 1,'email' => 'johndoe@example.com', 'dob' => '1996-01-01', 'extra' => $extra));
    }

}
