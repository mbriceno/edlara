<?php
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
$newexamsdone =  DB::select(DB::raw('SELECT COUNT(`id`) as count FROM `assessments` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) AND (`assessmenttype` = \'exam\')'));
$newassessmentsdone =  DB::select(DB::raw('SELECT COUNT(`id`) as count FROM `assessments` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) AND ((`assessmenttype` = \'presentation\') OR (`assessmenttype` = \'documentation\')) '));
$newtutorials =  DB::select(DB::raw('SELECT COUNT(`id`) as count FROM `tutorials` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) '));
$newusers =  DB::select(DB::raw('SELECT COUNT(`id`) as count FROM `users` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) '));
$max_examscore =  DB::select(DB::raw('SELECT MAX(`marks`) as marks FROM `assessments` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) AND (`assessmenttype` = \'exam\') '));
$newexamsdone = objectToArray($newexamsdone);
$newassessmentsdone = objectToArray($newassessmentsdone);
$newtutorials = objectToArray($newtutorials);
$newusers = objectToArray($newusers);
$max_examscore = objectToArray($max_examscore);
?>

<div class="box span4">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-list"></i> Weekly Stat</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="dashboard-list">
                            <li>
                                <a href="#">
                                    <i class="icon-arrow-up"></i>                
                                    <span class="green">{{$newexamsdone[0]['count']}}</span>
                                    New Exams Done By Students                                   
                                </a>
                            </li>
                          <li>
                            <a href="#">
                              <i class="icon-user"></i>
                              <span class="red">{{$newusers[0]['count']}}</span>
                              New Registrations
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="icon-edit"></i>
                              <span class="blue">{{$newtutorials[0]['count']}}</span>
                              New Tutorials                                   
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <i class="icon-comment"></i>
                              <span class="yellow">{{$max_examscore[0]['marks']}}</span>
                              Maximum Exam Score by a Student                       
                            </a>
                          </li>
                        </ul>
                    </div>
                </div><!--/span-->