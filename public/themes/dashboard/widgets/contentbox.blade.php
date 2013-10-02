<div class="container">
    <div class="row">
     <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 box">
        <div class="box-header">
            <h2><i class="icon-user"></i> Member Activity</h2>

        </div>
        <div class="box-content">
            <div class="box-content">
                <ul class="dashboard-list-user">
                    <?php
                    $users =  DB::select(DB::raw('SELECT id,email,first_name,last_name,created_at,activated FROM `users` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) ORDER BY `id` DESC LIMIT 5'));
                    foreach($users as $user){
                                            // user email
                        $email = $user->email;

                                            // create some gravatarer object 
                        $url = Gravatarer::make( [
                            'email' => $email, 
                            'size' => 50, 
                            'defaultImage' => 'mm',
                            'rating' => 'g',
                            ])->url();
                        echo "<li>";
                        echo "<a href='#'>";
                        echo "<img class='dashboard-avatar' alt='".$email."' src='".$url."'></a><strong>Name:</strong><a href='/user/".$user->id."/view/'>".$user->first_name.' '.$user->last_name.'</a><br>';
                        echo "<strong>Since:</strong>".$user->created_at.'<br>';
                        echo "<strong>Status:</strong>";
                        if($user->activated == 1){
                            echo '<span class="label label-success">Activated</span>';
                        }
                        else {                                
                            echo '<span class="label label-danger">Not Activated</span>';
                        }
                        echo "</li>";
                                            // get gravatar <img> html code
                                            // $html = $gravatar->html();
                    }
                    ?>   



                </ul>
            </div>
        </div>
    </div><!--/span-->
    <?php

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

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 box">
        <div class="box-header">
            <h2><i class="icon-list"></i> Weekly Stat</h2>

        </div>
        <div class="box-content">
            <ul class="dashboard-list">
                <li>
                    <a href="#">
                        <i class="icon-grey icon-arrow-up icon16"></i>                
                        <span class="green">{{$newexamsdone[0]['count']}}</span>
                        New Exams Done By Students                                   
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user icon16"></i>
                        <span class="red">{{$newusers[0]['count']}}</span>
                        New Registrations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-edit icon16 icon-green"></i>
                        <span class="blue">{{$newtutorials[0]['count']}}</span>
                        New Tutorials                                   
                    </a>
                </li>
                <li>
                    <a data-rel="tooltip" title="{{($max_examscore[0]['marks'])?$max_examscore[0]['marks'].' exams done':'No Exams done by Students';}}" href="#">
                        <i class="icon-newspaper icon16"></i>
                        <span class="yellow">{{($max_examscore[0]['marks'])?$max_examscore[0]['marks']:'0';}}</span>
                        is Maximum Exam Score by a Student                       
                    </a>
                </li>
            </ul>
        </div>
    </div><!--/span-->
</div>
</div>
