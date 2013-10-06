<?php

defined('ROOT' )|| die('Restricted Access');
echo $errors->first();
?>                        <div class="row well">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <?php
                    $assessment = Assessments::findOrFail($id);                   
                    echo Form::open(array('url' => '/assessment/'.$id,'method' => 'POST','class'=>'form-horizontal','files'=>'true'));
                    echo "<fieldset>";
                    echo Form::label('id','ID',array('class'=>'pull-left','style'=>'margin:15px;'));
                    echo Form::text('id',$assessment->id,array('class'=>'form-control pull-right uneditable-input','style'=>'margin:5px;','readonly'));
                    echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    echo Form::text('title',$assessment->title,array('class'=>'form-control pull-right disabled uneditable-input','placeholder'=>'Title of the Assessment','style'=>'clear:right;margin:5px;','readonly'));
                    echo Form::label('description','Description',array('class'=>'pull-left','style'=>'margin:15px;clear:left;'));
                    echo Form::text('description',$assessment->description,array('class'=>'form-control pull-right disabled uneditable-input','placeholder'=>'Small Description of the Assessment','style'=>'clear:right;margin:5px;','readonly'));
                    echo Form::label('related_tutorial','Related Tutorial',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    $tutorialid = $assessment->tutorialid;
                    $tutoriallist = array();
                    // $tutorial = Tutorials::where('id','=',$tutorialid);
                    // var_dump($tutorial);
                    if($tutorialid !== NULL){
                        $tutorial= Tutorials::findOrFail($tutorialid);
                        $tutoriallist[$tutorial->id] = $tutorial->name;
                        $teacher = User::findOrFail($tutorial->createdby);
                        echo Form::select('related_tutorial',$tutoriallist,Session::get('tutorialid'),array('class'=>'form-control pull-right uneditable-input','style'=>'clear:right;margin:5px;width:200px;'));
                    }
                    echo Form::label('submitted_to',"Submitted To",array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    $teacherlist = [$teacher->id => $teacher->first_name.' '.$teacher->last_name];
                    echo Form::select('submitted_to',$teacherlist,$teacher->id,array('class'=>'pull-right form-control  disabled uneditable-input','style'=>'clear:right;margin:5px;width:200px;','readonly'));
                    echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    $subjectid = $tutorial->subjectid;
                    $subject = Subject::findOrFail($subjectid);
                    $subjectlist = [$subjectid => $subject->subjectname];
                    echo Form::select('subject',$subjectlist,$subjectid,array('class'=>'form-control pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;width:200px;','readonly'));
                    echo Form::label('assessment_type','Assessment Type',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    $assessment_types = ['presentation'=>"Presentation",'document'=>'Documentation'];
                    echo Form::select('assessment_type',$assessment_types,'presentation',array('class'=>'pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;height:30px;','readonly'));
                    $tutorial = Tutorials::find($assessment->tutorialid);
                    $examdata = unserialize($tutorial->exams);
                    if($assessment->assessmenttype == 'exam'){

                        echo "<a href='/assessment-".$assessment->id.'/exam-'.$examdata['id'].'/markup\' style="clear:right;margin:10px;" class="btn btn-success btn-small pull-right form-control ">MarkUp by Default Answers Provided</a>';
                    }
                    else {                        
                    }
                    echo Form::label('marks',"Marks",array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    echo Form::text('marks',$assessment->marks,array('class'=>'form-control pull-right','style'=>'clear:right;margin:5px;'));                    
                    echo Form::label('remarks','Results',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    echo Form::textarea('remarks',$assessment->result,array('class'=>'form-control pull-right','style'=>'clear:right;','rows'=>'3'));
                    echo "</fieldset><br><br>";
                    echo Form::submit('Update',array('class'=>' pull-left btn btn-success','value'=>'submit','style'=>'clear:both;position:relative;'));
                    echo Form::close();
                    ?>
                </div>
                <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>

                    <h4>Current Attachments</h4>
                        <table id="attachments" class="table table-striped table-bordered bootstrap-datatable datatable">
                                    <thead>
                                        <tr>
                                            <th>#id</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                if(is_dir(app_path().'/attachments/assessment-'.$id)){
                                $types = array(
                                'jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF','PDF','pdf','bmp','BMP'
                                 );
                                $folder = app_path().'/attachments/assessment-'.$id;
                                $it = new RecursiveDirectoryIterator($folder);
                                $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                                foreach ($files as $file) {
                                    if (is_file($file)) {
                                        $attachpath = app_path().'/attachments/assessment-'.$assessment->id.'/';
                                        $filename = str_replace($attachpath, '', $file);
                                             echo "<tr>";
                                             echo "<td>";
                                             echo "1";
                                             echo "</td>";
                                             echo "<td>";
                                             echo $filename;
                                             echo "</td>";
                                             echo "<td>";
                                             echo "<a class='btn btn-small' href='/attachments/assessment-".$id.'/'.$filename."/download/'>Download</a>";
                                             echo "</td>";
                                             echo "</tr>";
                                                }
                                }
                                }
                                ?>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            <br>&nbsp;
                            <br>&nbsp;
                            <br>&nbsp;
                            <br>
                            <?php
                             $examdata = unserialize($tutorial->exams);
                            if($assessment->assessmenttype == 'exam'){
                            ?>
                            <div class="clearfix visible-sm visible-xs"></div>
                            <div  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h4>Table of Failed Questions and Answers by Student</h4>
                            <table id="questionfail" class="table table-striped table-bordered bootstrap-datatable datatable"> 
                            <thead>
                                <tr>
                                    <th>Question No</th>
                                    <th>Question</th>
                                    <th>Answer(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $wronganswers = File::get(app_path().'/files/assessment/'.$assessment->id.'/exam-'.$examdata['id'].'/questionfailed.json');
                            $examy = Exams::findOrFail($examdata['id']);
                            $hash = $examy->hash;

                            $wronganswers = json_decode($wronganswers,true);
                            if(isset($wronganswers['questions'])){
                            foreach($wronganswers['questions'] as $key =>$value){
                                echo "<tr><td>".$key."</td>"."<td>".$value."</td>";
                                echo "<td>";

                                $examdata_encoded =  File::get(app_path().'/files/exam-'.$examy->id.'/'.$hash.'.json');
                                $examdata = json_decode($examdata_encoded,true);
                                foreach($wronganswers['questions_fail'][$key][0] as $answerr){
                                    if($answerr != 0){
                                        echo "<b>".$answerr."</b>. ";
                                        echo $examdata['questiondata']['question'][$key]['checkboxdata'][$answerr]."<br>";
                                    }
                                }
                                echo "</td>";
                                echo "</tr>";
                            }}

                            ?>
                                    
                            </tbody>
                            </table>
                            <a id="showquestions" class="btn btn-success ">Show Questions</a>

                            <a class="hidequestions btn btn-warning">Hide Questions</a>
                            </div>

                           
                            <div class="clearfix"></div>
                            <div id="examslock" style="height:40px;">
                            </div>
                                <h3 id="examsheader">Questions</h3>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php

                             $examdata = unserialize($tutorial->exams);

                            $exam = Exams::find($examdata['id']);
                            $hash = $exam->hash;
                            $examdata_encoded =  File::get(app_path().'/files/exam-'.$exam->id.'/'.$hash.'.json');
                            Session::put('questiondata_key',1);
                            $examdata = json_decode($examdata_encoded);

                            $examdata = objectToArray($examdata);
                            echo "\n<div id='exams' style='clear:both;'>";

                            $qcc = 0;
                            foreach($examdata['questiondata']['questions'] as $qc => $question){
                                if(isset($examdata['questiondata']['questions'][$qc])){
                                    $qcc++;
                                }

                                if(isset($examdata['questiondata']['questions'][$qc])){
                                    $checked1='';
                                    $checked2='';
                                    $checked3='';
                                    $checked4='';

                                    if(isset($examdata['questiondata']['question'][$qc]['answers'])){
                                        $answers=$examdata['questiondata']['question'][$qc]['answers'];
                                        if(in_array("1",$answers)){
                                            $checked1='checked';
                                        }
                                        if(in_array("2",$answers)){
                                            $checked2='checked';
                                        }
                                        if(in_array("3",$answers)){
                                            $checked3='checked';
                                        }
                                        if(in_array("4",$answers)){
                                            $checked4='checked';
                                        }
                                    }

                                    echo "<div id='examdata' class='container'>\n";

                                    echo "<div class='row'>\n";

                                    echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>\n";
            //Question
                                    echo '<label for="examdatac">MCQ Question '.$qcc.'</label>';
                                    echo "\n";
                                    echo '<input class="examquestion form-control" id="examdatac" name="question_'.$qc.'" placeholder="Place the MCQ Question '.$qcc.' Here" type="text" value="'.Input::old('question_'.$qc,$question).'" required readonly>';
                                    echo "</div>\n";
                                    echo "\n";
                                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                                    echo "\n";
                                    echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="1" type="checkbox" '.$checked1.'  readonly>
                                    <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_1" placeholder="Place the Choice 1 here" type="text" value="'.Input::old('checkbox_'.$qc.'_1',$examdata['questiondata']['question'][$qc]['checkboxdata'][1]).'" required readonly>';
                                    echo "</div>";
                                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                                    echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="2" type="checkbox" '.$checked2.' readonly>
                                    <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_2" placeholder="Place the Choice 2 here" type="text" value="'.Input::old('checkbox_'.$qc.'_2',$examdata['questiondata']['question'][$qc]['checkboxdata'][2]).'" required readonly>';
                                    echo "\n";
                                    echo "</div>";
                                    echo "\n";
                                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                                    echo "\n";
                                    echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="3" type="checkbox" '.$checked3.' readonly>
                                    <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_3" placeholder="Place the Choice 3 here" type="text" value="'.Input::old('checkbox_'.$qc.'_3',$examdata['questiondata']['question'][$qc]['checkboxdata'][3]).'" required readonly>';
                                    echo "\n";
                                    echo "</div>";
                                    echo "\n";
                                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>";
                                    echo "\n";
                                    echo '<input style="" id="examdatac" class="checkboxpick pull-left form-control" name="checkbox_'.$qc.'[]" value="4" type="checkbox" '.$checked4.' readonly>
                                    <input  class="form-control checkboxdata"  name="checkbox_'.$qc.'_4" placeholder="Place the Choice 4 here" type="text" value="'.Input::old('checkbox_'.$qc.'_4',$examdata['questiondata']['question'][$qc]['checkboxdata'][4]).'" required readonly>';
                                    echo "\n";
                                    echo "</div>";
                                    echo "\n";
                                    echo "</div>\n"; 

                                    echo '<a class="hidequestions btn btn-warning">Hide Questions</a>';
                                }   
                                echo "</div>";       
                            }

                            }

                            ?>
                            </div>
                            </div>
                        