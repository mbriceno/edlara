<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">

        <?php
        if($errors->first()){
            echo "<div class='alert alert-error alert-block fade in'>";
            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
            echo $errors->first();                            
            echo "</div>";
        }
        echo Form::open(array('url' => '/exam/edit/'.$id, 'method' => 'post','class'=>'form-horizontal'));
        echo "<fieldset>";
        echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

        echo Form::text('id','0',array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

        echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

        echo Form::text("title",'',array('placeholder'=>'Title of the Exam','class'=>'pull-right form-control','style'=>'clear:right;margin:10px;'));                           
        echo Form::label('timing','Max Time',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        echo Form::text('timing','0',array('placeholder'=>'Maximum Time to do the Exam','class'=>'pull-right','style'=>'clear:right;margin:10px;'));
        echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        $subjectsmodel = Subject::all();
        function checkSubject($subjects,$subject){
        foreach($subjects as $s){
            if($s == $subject){
            return 1;
            }
         }
        return 0;
        }
        $usere = Sentry::getUser();
        $usergroup =  $usere->getGroups();
        $usergroupe = json_decode($usergroup,true);
        $usergroupe[0]['pivot']['group_id'];
        $group = Sentry::findGroupById($usergroupe[0]['pivot']['group_id']);
        $groupname = $group->name;
        if($groupname == 'teachers'){
            $user = Teacher::findOrFail($usere->id);
        }
        elseif($groupname == 'admin'){
            $user = Teacher::findOrFail($usere->id);
        }
        
        // $user = Sentry::getUser();
        // $student = Student::findOrFail($user->id);
        $ssubjects = $user->extra;
        $subjects = unserialize($ssubjects);
        $subjectlist = array();
        foreach ($subjectsmodel as $subject){
            $truth = checkSubject($subjects,$subject->id);
            if($truth == 1 && Sentry::getUser()->inGroup(Sentry::findGroupByName('teachers'))){
                $subjectlist[$subject->id] = $subject->subjectname;
            } 
            if(Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){
                 $subjectlist[$subject->id] = $subject->subjectname;
            }
            
        }

        echo Form::select('subject',$subjectlist,$subject->id,array('class'=>'pull-right','style'=>'clear:right;margin:10px;'));
        Session::put('questiondata_key',1);

        echo "<div class='clearfix'></div><h3>Questions</h3>";
        echo "\n<div id='exams' style='clear:both;'>";
                $qucount = Input::old('questioncount',5);
                for($i=1;$i<=$qucount;$i++){
$qc = $i;
                echo "<div id='examdata' class='container'>\n";

                echo "<div class='row'>\n";

                echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>\n";
            //Question
                echo '<label for="examdatac">MCQ Question '.$qc.'</label>';
                echo "\n";
                echo '<input class="examquestion form-control" id="examdatac" name="question_'.$qc.'" placeholder="Place the MCQ Question '.$qc.' Here" type="text" value="'.Input::old('question_'.$qc).'" required>';
                echo "</div>\n";
                echo "\n";
                echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo "\n";
                echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="1" type="checkbox" >
                <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_1" placeholder="Place the Choice 1 here" type="text" value="'.Input::old('checkbox_'.$qc.'_1').'" required>';
                echo "</div>";
                echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="2" type="checkbox">
                <input  class="form-control checkboxdata "  name="checkbox_'.$qc.'_2" placeholder="Place the Choice 2 here" type="text" value="'.Input::old('checkbox_'.$qc.'_2').'" required>';
                echo "\n";
                echo "</div>";
                echo "\n";
                echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo "\n";
                echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="3" type="checkbox" >
                <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_3" placeholder="Place the Choice 3 here" type="text" value="'.Input::old('checkbox_'.$qc.'_3').'" required>';
                echo "\n";
                echo "</div>";
                echo "\n";
                echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                echo "\n";
                echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="4" type="checkbox" >
                <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_4" placeholder="Place the Choice 4 here" type="text" value="'.Input::old('checkbox_'.$qc.'_4').'" required>';
                echo "\n";
                echo "</div>";
                echo "\n";
                echo "</div>\n";
                echo '<input type="hidden" value="0" name="checkbox_'.$qc.'[]">';
                if($qc >= 6){
                    echo '<a class="btn btn-warning removeMCQ">Remove</a>';
                }
                echo "</div>\n";

                echo   '<input name="checkbox_'.$qc.'[]" value="0" type="hidden">';
                }          
        
        echo '<input id="questioncount" name="questioncount" type="hidden" value="'.$qc.'"></div>';  
        ?>

    <a class="btn btn-success" id="addMCQ">Add Another MCQ Question</a>
    <?php


    echo Form::submit('Update',array('class'=>'btn btn-success','value'=>'submit'));
    echo '
    <a class="btn btn-danger" href="/exams">Cancel</a></fieldset>';
    echo Form::close();
    ?> 
</div>
</div>
    <!-- external javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery -->
    <script src="/js/jquery-1.7.2.min.js"></script>   
    <script type="text/javascript">
    $(function(){
        var exams = $('#exams');
        var i = $('#exams div#examdata').size()+1;

        $('#addMCQ').click(function(){
            $('#questioncount').remove();
            $('<div class="container" id="examdata"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label for="examdata">MCQ Question '+i+'</label><input type="text" required="" placeholder="Place the MCQ Question '+i+' Here" name="question_'+i+'" id="examdata" class="examquestion form-control"></div><div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><input type="checkbox" value="1" name="checkbox_'+i+'[]" class="checkboxpick pull-left form-control" id="examdata" style=""><input type="text" required="" placeholder="Place the Choice 1 here" name="checkbox_'+i+'_1" class="form-control checkboxdata"></div><div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><input type="checkbox" value="2" name="checkbox_'+i+'[]" class="checkboxpick pull-left form-control" id="examdata" style=""><input type="text" required="" placeholder="Place the Choice 2 here" name="checkbox_'+i+'_2" class="form-control checkboxdata"></div><div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><input type="checkbox" value="3" name="checkbox_'+i+'[]" class="checkboxpick pull-left form-control" id="examdata" style=""><input type="text" required="" placeholder="Place the Choice 3 here" name="checkbox_'+i+'_3" class="form-control checkboxdata"></div><div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><input type="checkbox" value="4" name="checkbox_'+i+'[]" class="checkboxpick pull-left form-control" id="examdata" style=""><input type="text" required="" placeholder="Place the Choice 4 here" name="checkbox_'+i+'_4" class="form-control checkboxdata"></div></div><input type="hidden" value="0" name="checkbox_' + i + '[]"><a  class="btn btn-warning removeMCQ">Remove</a></div><input id="questioncount" name="questioncount" type="hidden" value="' + i + '">').appendTo(exams);
            i++;
            return false;
        });
        $('.removeMCQ').click(function(){ 
            // if( i >= 4 ) {
                $(this).parents('div#examdata').remove();
                $('#questioncount').remove();

            --i;

            $('<input id="questionpass" name="questionpass'+ --i +'" type="hidden" value="'+i+'"><input id="questioncount" name="questioncount" type="hidden" value="' + ++i + '">').appendTo(exams);
            // }
            i++;
            return false;
            });
    });


</script>