<?php
$studentquery = DB::select(DB::raw('SELECT COUNT(`dob`) FROM `students` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$userquery = DB::select(DB::raw('SELECT COUNT(`email`) FROM `users` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$tutorialquery = DB::select(DB::raw('SELECT COUNT(`id`) FROM `tutorials` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$assessmentquery = DB::select(DB::raw('SELECT COUNT(`id`) FROM `assessments` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }
 
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }
$stresult = objectToArray($studentquery);
$usresult = objectToArray($userquery);
$turesult = objectToArray($tutorialquery);
$asresult = objectToArray($assessmentquery);


$todayusercount = $usresult[0]['COUNT(`email`)'];
$usercountall = User::all()->count();
$usercountall -= 1;


$todaystudentcount = $stresult[0]['COUNT(`dob`)'];
$studentcountall = Student::all()->count();
$studentcountall -=1;


$todaytutorialcount = $turesult[0]['COUNT(`id`)'];
$tutorialcountall = Tutorials::all()->count();

$todayassessmentcount = $asresult[0]['COUNT(`id`)'];
$assessmentcountall = Assessments::all()->count();

?>
<?php 

 ?>
<div class="sortable row-fluid">
                <a data-rel="tooltip" title="{{ $todayusercount }} new members." class="well span3 top-block" href="#">
                    <span class="icon32 icon-red icon-user"></span>
                    <div>Total Members</div>
                    <div>{{ $usercountall }}</div>
                    <span class="notification">{{ $todayusercount }}</span>
                </a>

                <a data-rel="tooltip" title="{{ $todaystudentcount }} new students." class="well span3 top-block" href="#">
                    <span class="icon32 icon-blue icon-user"></span>
                    <div>Total Students</div>
                    <div>{{ $studentcountall }} </div>
                    <span class="notification blue">{{ $todaystudentcount }}</span>
                </a>

                <a data-rel="tooltip" title="{{$todaytutorialcount }} New Tutorials Today" class="well span3 top-block" href="#">
                    <span class="icon32 icon-page icon-green"></span>
                    <div>Total Tutorials</div>
                    <div>{{$tutorialcountall }}</div>
                    <span class="notification green">{{$todaytutorialcount }}</span>
                </a>
                
                <a data-rel="tooltip" title="{{$todayassessmentcount}} new Assessments Submitted." class="well span3 top-block" href="#">
                    <span class="icon32 icon-orange icon-document"></span>
                    <div>Total Assessments</div>
                    <div>{{$assessmentcountall }}</div>
                    <span class="notification red">{{$todayassessmentcount}}</span>
                </a>
</div>