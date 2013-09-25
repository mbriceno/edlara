<?php

class TeacherTableSeeder extends Seeder {
    public function run() {

        DB::table('teachers')->delete();
        $extra = array('1','2','3','4');
        $extra = serialize($extra);
        Teacher::create(array('user_id' => 1, 'email' => 'johndoe@example.com', 'dob' => '1996-01-01', 'extra' => $extra));
    }

}
