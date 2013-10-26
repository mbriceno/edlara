<?php

defined('ROOT' )|| die('Restricted Access');
        $exams[0]='';
        $possibleexamid=0;

?><?php
$tutorial = Tutorials::find($id);
// var_dump($tutorial);?>
<div class="row">
    <?php

    echo Form::open(array('url' => '/tutorial/edit/'.$id.'/update', 'method' => 'POST','class'=>'form-horizontal','files'=>'true'));
    echo "<fieldset>";
    echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
    echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

    echo Form::text('id',$id,array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

    echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

    echo Form::text("title",$tutorial->name,array('placeholder'=>'Title of the Tutorial','class'=>'pull-right form-control','style'=>'clear:right;margin:10px;'));

    echo Form::label('description','Description',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

    echo Form::text("description",$tutorial->description,array('placeholder'=>'Describe the Tutorial Here','class'=>'pull-right form-control','style'=>'clear:right;margin:10px;'));

    echo Form::label('subject','Subject',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

    $subject = Subject::find($tutorial->subjectid);
    $subjectlist[$subject->id] = $subject->subjectname;
    echo Form::select('subject',$subjectlist,$tutorial->subjectid,array('class'=>'form-control pull-right','style'=>'clear:right;margin:10px;'));
    ?></div>
    <div class="clearfix visible-xs visible-sm"></div>


    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="control-group">
            <label class="control-label">Created Date</label>
            <div class="controls">
                <span class="input-xlarge uneditable-input">{{ $tutorial->created_at }}</span>
            </div>
        </div>
        <label class="control-label">Updated Date</label>
        <div class="controls">
            <span class="input-xlarge uneditable-input">{{ $tutorial->updated_at }}</span>
        </div>
        <label class="control-label">Created By</label>
        <div class="controls">
            <span class="input-xlarge uneditable-input">
                <?php


                $teacher = Teacher::find($tutorial->createdby);
                $username = Sentry::findUserByLogin($teacher->email);
                echo $username->first_name.' '.$username->last_name

                ?>
            </span>
        </div><br>
        <?php
        echo "<a href='/tutorial/edit/".$tutorial->id."/presentation' class='btn btn-success'>Create Presentation</a>" ?>
    </div>
    <div class="clearfix"></div>



    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <?php
        echo Form::label('tutorial',"Tutorial Content",array('class'=>'pull-left control-label','style'=>''));
        echo "<div class='controls' style='clear:both;'>";
        echo Form::textarea('tutorial',$tutorial->content,array('class'=>'','rows'=>'10','placeholder'=>"Tutorial Explanation Here",'style'=>''));
        echo '</div></div><br><br>';


        echo Form::label('published','Published',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        if($tutorial->published === 1){
            $checked ='checked="checked"';
        }
        else
        {
            $checked = '';
        }
        echo '<div class="make-switch pull-right"><input type="checkbox" name="published" id="published" '.$checked.'></div>';



        echo Form::label('attachments','Attachment',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        echo Form::file('attachments[]', array('class'=>"pull-right",'style'=>'clear:right;','multiple'=>'multiple'));
        echo "<br>";
        echo "<br>";
        $checkexams = DB::select(DB::raw('SELECT COUNT(`id`) as `exists` FROM `exams` WHERE `subjectid` = '.$tutorial->subjectid));
            $checkexams = objectToArray($checkexams);
            // dd($checkexams[0]['exists']);
        if($checkexams[0]['exists'] !== 0){
            $possibleexams = Exams::where('subjectid','=',$tutorial->subjectid)->get();
            foreach($possibleexams as $possibleexam){
                $exams[$possibleexam->id]=$possibleexam->title;
                $possibleexamid = $possibleexam->id;
            }

        }
        elseif (!isset($checkexams) || $checkexams==0) {                                
            $exams[0]="No Matched Exams found. Please create a Exam before attaching it.";
            $possibleexamid = 0;
        }
        $exame = $tutorial->exams;
        $exame = unserialize($exame);
    // if($exame['id']){
    //     $possibleexamid = $exame['id'];
    // }
        echo Form::label('examstruth','Enable Exam',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        if($exame['true'] == true){
            $checked ='checked="checked"';
        }
        else
        {
            $checked = '';
        }
        echo '<div class="make-switch pull-right"><input value="on" type="checkbox" name="examstruth" id="examstruth" '.$checked.'></div>';
        $exams[]='';
        echo Form::label('exams','Exams to Use',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
        echo Form::select('exams',$exams,$possibleexamid,array('class'=>'pull-right','style'=>'clear:right;margin:5px;'));
        echo "</fieldset>";

        echo Form::submit('Save Changes',array('class'=>'btn btn-success','value'=>'submit'));
        echo '
        <a class=" btn btn-danger" href="/tutorials">Close</a>';
        echo Form::close();
        ?><br><br>
        <div class="clearfix"></div>
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">

            <label class="control-label">Current Attachments</label>
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

                    if(is_dir(app_path().'/attachments/tutorial-'.$id)){
                        $types = array(
                            'jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF','PDF','pdf','bmp','BMP'
                            );
                        $folder = app_path().'/attachments/tutorial-'.$id;
                        $it = new RecursiveDirectoryIterator($folder);
                        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                        foreach ($files as $file) {
                            if (is_file($file)) {
                                $attachpath = app_path().'/attachments/tutorial-'.$tutorial->id.'/';
                                $filename = str_replace($attachpath, '', $file);
                                echo "<tr>";
                                echo "<td>";
                                echo "1";
                                echo "</td>";
                                echo "<td>";
                                echo $filename;
                                echo "</td>";
                                echo "<td>";
                                echo "<a class='btn btn-small' href='/tutorial/update/".$id.'/'.$filename."/download/'>Download</a><a class='btn btn-small btn-danger' href='/tutorial/update/".$id.'/'.$filename."/delete/'>Delete</a>";
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

    <script>
        window.onload = function() {
            CKEDITOR.replace( 'tutorial' , {
                toolbar: 'Basic',
                uiColor: '#9AB8F3'
            });
        };
    </script>