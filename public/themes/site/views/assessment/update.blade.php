<div class='row'>
    <div class="col-md-7 offset-md-2">
        <?php
        $assessment = Assessments::findOrFail($id);
        if($errors->first('title')){

            echo "<div class='alert alert-error alert-block fade in'>";
            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
            echo $errors->first('title');                            
            echo "</div>";
        }
        if($errors->first('related_tutorial')){

            echo "<div class='alert alert-error alert-block fade in'>";
            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
            echo $errors->first('related_tutorial');
            echo "</div>";
        }
        echo $errors->first();
        echo Form::open(array('url' => '/assessment/update/'.$id,'method' => 'POST','class'=>'form-horizontal','files'=>'true'));

        echo Form::label('id','ID',array('class'=>'pull-left','style'=>'margin:10px;'));
        echo Form::text('id',$assessment->id,array('class'=>'pull-right disabled uneditable-input','style'=>'margin:5px;','readonly'));
        echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        echo Form::text('title',$assessment->title,array('class'=>'pull-right form-control','placeholder'=>'Title of the Assessment','style'=>'width:50%;clear:right;margin:5px;'));
        echo Form::label('description','Description',array('class'=>'pull-left','style'=>'margin:10px;clear:left;'));
        echo Form::text('description',$assessment->description,array('class'=>'pull-right form-control','placeholder'=>'Small Description of the Assessment','style'=>'clear:right;width:50%;margin:5px;'));
        echo Form::label('related_tutorial','Related Tutorial',array('class'=>'pull-left','style'=>'clear:left;margin:10px'));
        $tutorialid = Session::get('tutorialid',1);
        $tutoriallist = array();
                    // $tutorial = Tutorials::where('id','=',$tutorialid);
                    // var_dump($tutorial);
        if($tutorialid !== NULL){
            $tutorial= Tutorials::findOrFail($tutorialid);
            $tutoriallist[$tutorial->id] = $tutorial->name;
            $teacher = User::findOrFail($tutorial->createdby);
            echo Form::select('related_tutorial',$tutoriallist,Session::get('tutorialid'),array('class'=>'pull-right form-control uneditable-input','style'=>'clear:right;width:50%;margin:5px;height:30px;'));
        }
        echo Form::label('submitted_to',"Submitted To",array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        $teacherlist = [$teacher->id => $teacher->first_name.' '.$teacher->last_name];
        echo Form::select('submitted_to',$teacherlist,$teacher->id,array('class'=>'pull-right disabled uneditable-input form-control','style'=>'clear:right;margin:5px;width:50%;height:30px;'));
        echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        $subjectid = $tutorial->subjectid;
        $subject = Subject::findOrFail($subjectid);
        $subjectlist = [$subjectid => $subject->subjectname];
        echo Form::select('subject',$subjectlist,$subjectid,array('class'=>'pull-right disabled uneditable-input form-control','style'=>'width:50%;clear:right;margin:5px;height:30px;'));
        if($assessment->assessmenttype !== 'exam'){
            echo Form::label('assessment_type','Assessment Type',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
            $assessment_types = ['presentation'=>"Presentation",'document'=>'Documentation'];
            $examdata = unserialize(Tutorials::find($assessment->tutorialid)->exams);
            echo Form::select('assessment_type',$assessment_types,'presentation',array('class'=>'pull-right form-control','style'=>'width:50%;clear:right;margin:5px;'));

            echo Form::label('attachments','Attachments',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
            echo Form::file('attachments[]',array('multiple'=>'true','class'=>'pull-right','style'=>'clear:right;margin:5px;'));
        }
        echo Form::label('marks','Marks',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        echo Form::text('marks',$assessment->marks,array('class'=>'pull-right','style'=>'clear:right;margin:5px;','readonly'));
        echo Form::submit('Submit',array('class'=>' pull-left btn btn-success','value'=>'submit','style'=>'clear:both;'));
        echo Form::close();
        ?>
    </div>

        <div class="clearfix visible-xs visible-sm"></div>
    <div class='col-md-3'>
        <h4>Current Attachments</h4>
        <table id="attachment" class="table table-striped table-bordered bootstrap-datatable datatable">
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
                    $n = 0;
                    function viewMaker($id,$path,$filename){
                        $ext = pathinfo($path,PATHINFO_EXTENSION);
                        switch ($ext){
                            case 'jpg':
                            return "<a href='/attachments/assessment-".$id.'/'.$filename."/view/'>View</a>";
                            case 'JPG':
                            return "<a href='/attachments/assessment-".$id.'/'.$filename."/view/'>View</a>";
                        }
                    }
                    foreach ($files as $file) {
                        if (is_file($file)) {
                            $attachpath = app_path().'/attachments/assessment-'.$assessment->id.'/';
                            $filename = str_replace($attachpath, '', $file);
                            echo "<tr>";
                            echo "<td>";
                            echo $n +=1;
                            echo "</td>";
                            echo "<td>";
                            echo $filename;
                            echo "</td>";
                            echo "<td>";
                            echo "<a class='btn btn-small' href='/attachments/assessment-".$id.'/'.$filename."/download/'>Download</a>";                 
                            echo viewMaker($id,$file,$filename);
                            echo "<a class='btn btn-small btn-danger' href='/attachments/assessment-".$id.'/'.$filename."/delete/'>Delete</a>";
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
    <?php
    $examdata = unserialize($tutorial->exams);
    if($assessment->assessmenttype == 'exam'){
        ?>
        <div class="clearfix"></div>
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

                    $examdata = unserialize(Tutorials::find($assessment->tutorialid)->exams);
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
            </div>
            <?php
        }

        ?></div>
    </div>
</div>
