<?php
$studentquery = DB::select(DB::raw('SELECT COUNT(`dob`) FROM `students` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$userquery = DB::select(DB::raw('SELECT COUNT(`email`) FROM `users` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$tutorialquery = DB::select(DB::raw('SELECT COUNT(`id`) FROM `tutorials` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));
$assessmentquery = DB::select(DB::raw('SELECT COUNT(`id`) FROM `assessments` WHERE `created_at` >= CURDATE() - INTERVAL 1 DAY'));

$stresult = objectToArray($studentquery);
$usresult = objectToArray($userquery);
$turesult = objectToArray($tutorialquery);
$asresult = objectToArray($assessmentquery);


$todayusercount = $usresult[0]['COUNT(`email`)'];
$usercountall = User::all()->count();


$todaystudentcount = $stresult[0]['COUNT(`dob`)'];
$studentcountall = Student::all()->count();


$todaytutorialcount = $turesult[0]['COUNT(`id`)'];
$tutorialcountall = Tutorials::all()->count();

$todayassessmentcount = $asresult[0]['COUNT(`id`)'];
$assessmentcountall = Assessments::all()->count();

?>
<?php 

 ?>
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <a data-rel="tooltip" title="{{ $todayusercount }} New member(s)." class="well span3 top-block" href="#">
                    <span class="icon32 icon-red icon-user"></span>
                    <div>Total Members</div>
                    <div>{{ $usercountall }}</div>
                    <span class="notification yellow">{{ $todayusercount }}</span>
                </a>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <a data-rel="tooltip" title="{{ $todaystudentcount }} New student(s)." class="well span3 top-block" href="#">
                    <span class="icon32 icon-blue icon-user"></span>
                    <div>Total Students</div>
                    <div>{{ $studentcountall }} </div>
                    <span class="notification blue">{{ $todaystudentcount }}</span>
                </a>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">

                <a data-rel="tooltip" title="{{$todaytutorialcount }} New Tutorial(s) Today" class="well span3 top-block" href="#">
                    <span class="icon32 icon-file-alt icon-green"></span>
                    <div>Total Tutorials</div>
                    <div>{{$tutorialcountall }}</div>
                    <span class="notification green">{{$todaytutorialcount }}</span>
                </a>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                
                <a data-rel="tooltip" title="{{$todayassessmentcount}} new Assessment(s) Submitted." class="well span3 top-block" href="#">
                    <span class="icon32 icon-orange icon-newspaper"></span>
                    <div>Total Assessments</div>
                    <div>{{$assessmentcountall }}</div>
                    <span class="notification red">{{$todayassessmentcount}}</span>
                </a>
        </div>
    </div>
</div>
