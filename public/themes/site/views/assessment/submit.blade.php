<div class='row'>
    <div class="col-md-6 col-xs-12 offset-md-2" style="padding:30px;">
        <?php
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
        $tutorialid = Session::get('tutorialid');
        $tutoriallist = array();
                    // $tutorial = Tutorials::where('id','=',$tutorialid);
                    // var_dump($tutorial);
    
        if($tutorialid !== NULL){
        echo Form::open(array('url' => '/assessment/submit/','method' => 'POST','class'=>'form-horizontal','files'=>'true'));

        echo Form::label('id','ID',array('class'=>'pull-left','style'=>'margin:10px;'));
        echo Form::text('id',0,array('class'=>'pull-right disabled uneditable-input','style'=>'margin:5px;'));
        echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        echo Form::text('title','',array('class'=>'pull-right','placeholder'=>'Title of the Assessment','style'=>'clear:right;margin:5px;'));
        echo Form::label('description','Description',array('class'=>'pull-left','style'=>'margin:10px;clear:left;'));
        echo Form::text('description','',array('class'=>'pull-right','placeholder'=>'Small Description of the Assessment','style'=>'clear:right;margin:5px;'));
            $tutorial= Tutorials::findOrFail($tutorialid);
            $tutoriallist[$tutorial->id] = $tutorial->name;
            $teacher = User::findOrFail($tutorial->createdby);
        echo Form::label('related_tutorial','Related Tutorial',array('class'=>'pull-left','style'=>'clear:left;margin:10px'));
        echo Form::select('related_tutorial',$tutoriallist,Session::get('tutorialid'),array('class'=>'pull-right uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
        echo Form::label('submitted_to',"Submitted To",array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        $teacherlist = [$teacher->id => $teacher->first_name.' '.$teacher->last_name];
        echo Form::select('submitted_to',$teacherlist,$teacher->id,array('class'=>'pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
        echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        $subjectid = $tutorial->subjectid;
        $subject = Subject::findOrFail($subjectid);
        $subjectlist = [$subjectid => $subject->subjectname];
        echo Form::select('subject',$subjectlist,$subjectid,array('class'=>'pull-right disabled uneditable-input','style'=>'clear:right;margin:5px;height:30px;'));
        echo Form::label('assessment_type','Assessment Type',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        $assessment_types = ['presentation'=>"Presentation",'document'=>'Documentation'];
        echo Form::select('assessment_type',$assessment_types,'presentation',array('class'=>'pull-right','style'=>'clear:right;margin:5px;'));
        echo Form::label('attachments','Attachments',array('class'=>'pull-left','style'=>'clear:left;margin:10px;'));
        echo Form::file('attachments[]',array('multiple'=>'true','class'=>'pull-right','style'=>'clear:right;margin:5px;'));
        echo Form::submit('Submit',array('class'=>' pull-left btn btn-success','value'=>'submit','style'=>'clear:both;'));
        echo Form::close();
        }
        ?>
    </div>
</div>