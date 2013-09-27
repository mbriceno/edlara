<?php
$examid = Session::get('examid');
$exam = Exams::find($examid);
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
    Session::put('halt_tutorial_except',$id);
$tohash = 'tutorial-'.$id;
$encrypted = Crypt::encrypt($tohash);
?>
<!doctype html>
<html>
    <head>
        <title>{{ Setting::get('system.schoolname') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>
                <div class="span12 offset1">
                    <?php
                            echo Form::open(array('url' => '/tutorial-'.$id.'/exam-'.$examid.'/'.$encrypted.'/', 'method' => 'post','class'=>'form-horizontal'));
                            echo "<fieldset>";
                            echo "<div class='container-fluid'><div class='row-fluid'><div class='span6'>";
                    echo Form::label('id','ID',array('class'=>'pull-left','style'=>'margin:20px;'));
                    echo Form::text('id',0,array('class'=>'pull-right disabled uneditable-input','style'=>'margin:20px;','disabled'));
                    echo Form::label('related_tutorial','Related Tutorial',array('class'=>'pull-left','style'=>'clear:left;margin:10px'));
                    $tutorialid = Session::get('tutorialid',1);
                    $tutoriallist = array();
                    // $tutorial = Tutorials::where('id','=',$tutorialid);
                    // var_dump($tutorial);
                    if($tutorialid !== NULL){
                        $tutorial= Tutorials::findOrFail($tutorialid);
                        $tutoriallist[$tutorial->id] = $tutorial->name;
                        $teacher = User::findOrFail($tutorial->createdby);
                        echo Form::select('related_tutorial',$tutoriallist,Session::get('tutorialid'),array('class'=>'pull-right uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
                    }
                    echo Form::label('submitted_to',"Submitted To",array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    $teacherlist = [$teacher->id => $teacher->first_name.' '.$teacher->last_name];
                    echo Form::select('submitted_to',$teacherlist,$teacher->id,array('class'=>'pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
                    echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    $subjectid = $tutorial->subjectid;
                    $subject = Subject::findOrFail($subjectid);
                    $subjectlist = [$subjectid => $subject->subjectname];
                    echo Form::select('subject',$subjectlist,$subjectid,array('class'=>'pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
                            echo Form::label('examid',"Exam ID",array('class'=>'pull-left','style'=>'margin:20px;clear:left;'));
                            echo Form::text('examid',$examid,array('style'=>'clear:right;margin:10px;','class'=>'pull-right disabled','disabled'));
                            echo "</div></div></div>";
                            echo "<h3>Questions</h3>";
                            echo "<div id='exams'>";
                            $hash = $exam->hash;
                            $examdata_encoded =  File::get(app_path().'/files/exam-'.$examid.'/'.$hash.'.json');
                            Session::put('questiondata_key',1);
                            $examdata = json_decode($examdata_encoded);
                            
                            $examdata = objectToArray($examdata);
                            foreach($examdata['questiondata']['questions'] as $question){

                                $qc = Session::get('questiondata_key',1);
        echo '<div class="container-fluid">
        <div class="row-fluid">
        <div class="span12">
        <label>'.$question.'</label>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span12 offset1">
        <input type="checkbox" name="checkbox_'.$qc.'[]" value="1" />'.$examdata['questiondata']['question'][$qc]['checkboxdata'][1].'<br>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span12 offset1">        
        <input type="checkbox" name="checkbox_'.$qc.'[]" value="2" />'.$examdata['questiondata']['question'][$qc]['checkboxdata'][2].'<br>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span12 offset1">        
        <input type="checkbox" name="checkbox_'.$qc.'[]" value="3" />'.$examdata['questiondata']['question'][$qc]['checkboxdata'][3].'<br>
        </div>
        </div>
        <div class="row-fluid">
        <div class="span12 offset1">        
        <input type="checkbox" name="checkbox_'.$qc.'[]" value="4" />'.$examdata['questiondata']['question'][$qc]['checkboxdata'][4].'<br>
        </div>
        </div>
        <input name="checkbox_'.$qc.'[]" value="0" type="hidden"/>
        </div><br>&nbsp;<br>&nbsp;<br>&nbsp;';
                            Session::put('questiondata_key',Session::get('questiondata_key')+1);    
                            }  
                            echo "</div>";
                            echo "</fieldset>";
                            echo Form::submit('Finish Exam',array('class'=>'btn btn-info btn-large')); 
                            echo Form::close();                
                            ?>
                </div>
            </div>
        </div>
        
        <div id='footer' class="pull-right" style="padding:20px;margin:20px;clear:right;">
            {{Setting::get('system.schoolname')}} &copy; {{date('Y')}}
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
            $('#navbar').scrollspy();
        </script>
    </body>
</html>