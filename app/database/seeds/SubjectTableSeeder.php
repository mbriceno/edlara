<?php

class SubjectTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('subjects') -> delete();
        Subject::create(array('subjectcode' => 'SC6','grade'=>'6','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA6','grade'=>'6','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI6','grade'=>'6','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN6','grade'=>'6','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'GE6','grade'=>'6','subjectname'=>'Geography'));
        Subject::create(array('subjectcode' => 'CI6','grade'=>'6','subjectname'=>'Citizenship Education'));
        Subject::create(array('subjectcode' => 'TA6','grade'=>'6','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI6','grade'=>'6','subjectname'=>'Sinhala'));
        Subject::create(array('subjectcode' => 'HS6','grade'=>'6','subjectname'=>'Health Science'));

        Subject::create(array('subjectcode' => 'SC7','grade'=>'7','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA7','grade'=>'7','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI7','grade'=>'7','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN7','grade'=>'7','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'GE7','grade'=>'7','subjectname'=>'Geography'));
        Subject::create(array('subjectcode' => 'CI7','grade'=>'7','subjectname'=>'Citizenship Education'));
        Subject::create(array('subjectcode' => 'TA7','grade'=>'7','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI7','grade'=>'7','subjectname'=>'Sinhala'));
        Subject::create(array('subjectcode' => 'HS7','grade'=>'7','subjectname'=>'Health Science'));


        Subject::create(array('subjectcode' => 'SC8','grade'=>'8','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA8','grade'=>'8','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI8','grade'=>'8','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN8','grade'=>'8','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'GE8','grade'=>'8','subjectname'=>'Geography'));
        Subject::create(array('subjectcode' => 'CI8','grade'=>'8','subjectname'=>'Citizenship Education'));
        Subject::create(array('subjectcode' => 'TA8','grade'=>'8','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI8','grade'=>'8','subjectname'=>'Sinhala'));
        Subject::create(array('subjectcode' => 'HS8','grade'=>'8','subjectname'=>'Health Science'));


        Subject::create(array('subjectcode' => 'SC9','grade'=>'9','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA9','grade'=>'9','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI9','grade'=>'9','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN9','grade'=>'9','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'GE9','grade'=>'9','subjectname'=>'Geography'));
        Subject::create(array('subjectcode' => 'CI9','grade'=>'9','subjectname'=>'Citizenship Education'));
        Subject::create(array('subjectcode' => 'TA9','grade'=>'9','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI9','grade'=>'9','subjectname'=>'Sinhala'));
        Subject::create(array('subjectcode' => 'HS9','grade'=>'9','subjectname'=>'Health Science'));


        Subject::create(array('subjectcode' => 'SC10','grade'=>'10','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA10','grade'=>'10','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI10','grade'=>'10','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN10','grade'=>'10','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'TA10','grade'=>'10','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI10','grade'=>'10','subjectname'=>'Sinhala'));

        Subject::create(array('subjectcode' => 'SC11','grade'=>'11','subjectname'=>'Science'));
        Subject::create(array('subjectcode' => 'MA11','grade'=>'11','subjectname'=>'Maths'));
        Subject::create(array('subjectcode' => 'HI11','grade'=>'11','subjectname'=>'History'));
        Subject::create(array('subjectcode' => 'EN11','grade'=>'11','subjectname'=>'English'));
        Subject::create(array('subjectcode' => 'TA11','grade'=>'11','subjectname'=>'Tamil'));
        Subject::create(array('subjectcode' => 'SI11','grade'=>'11','subjectname'=>'Sinhala'));


        Subject::create(array('subjectcode' => 'CM12','grade'=>'12','subjectname'=>'Combined Maths'));
    	Subject::create(array('subjectcode' => 'C12','grade'=>'12','subjectname'=>'Chemistry'));
    	Subject::create(array('subjectcode' => 'P12','grade'=>'12','subjectname'=>'Physics'));
        Subject::create(array('subjectcode' => 'B12','grade'=>'12','subjectname'=>'Bio Science'));
        Subject::create(array('subjectcode' => 'ET12','grade'=>'12','subjectname'=>'Engineering Technology'));
        Subject::create(array('subjectcode' => 'ST12','grade'=>'12','subjectname'=>'Science For Technology'));
        Subject::create(array('subjectcode' => 'IT12','grade'=>'12','subjectname'=>'Information Communication Technology'));
    
    }

}