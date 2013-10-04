<?php

defined('ROOT' )|| die('Restricted Access');
echo $errors->first();
?>                        <div class="row well">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <?php
                    $assessment = Assessments::findOrFail($id);                   
                    echo Form::open(array('url' => '/assessment/'.$id,'method' => 'POST','class'=>'form-horizontal','files'=>'true'));
                    echo "<fieldset>";
                    echo Form::label('id','ID',array('class'=>'pull-left','style'=>'margin:10px;'));
                    echo Form::text('id',$assessment->id,array('class'=>'form-control pull-right uneditable-input','style'=>'margin:5px;','readonly'));
                    echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    echo Form::text('title',$assessment->title,array('class'=>'form-control pull-right disabled uneditable-input','placeholder'=>'Title of the Assessment','style'=>'clear:right;margin:5px;','readonly'));
                    echo Form::label('description','Description',array('class'=>'pull-left','style'=>'margin:10px;clear:left;'));
                    echo Form::text('description',$assessment->description,array('class'=>'form-control pull-right disabled uneditable-input','placeholder'=>'Small Description of the Assessment','style'=>'clear:right;margin:5px;','readonly'));
                    echo Form::label('related_tutorial','Related Tutorial',array('class'=>'pull-left','style'=>'clear:left;margin:10px'));
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
                    echo Form::label('submitted_to',"Submitted To",array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    $teacherlist = [$teacher->id => $teacher->first_name.' '.$teacher->last_name];
                    echo Form::select('submitted_to',$teacherlist,$teacher->id,array('class'=>'pull-right form-control  disabled uneditable-input','style'=>'clear:right;margin:5px;width:200px;','readonly'));
                    echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
                    $subjectid = $tutorial->subjectid;
                    $subject = Subject::findOrFail($subjectid);
                    $subjectlist = [$subjectid => $subject->subjectname];
                    echo Form::select('subject',$subjectlist,$subjectid,array('class'=>'form-control pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;width:200px;','readonly'));
                    echo Form::label('assessment_type','Assessment Type',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
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
                            </div>