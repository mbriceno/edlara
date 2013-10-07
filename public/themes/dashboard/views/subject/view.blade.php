                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 well">
                            <?php
                            $subject = Subject::find($id);
                            echo "<fieldset>";
                            echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                            echo Form::text('id',$id,array('class'=>'form-control pull-right','style'=>'margin:10px;','readonly'));

                            echo Form::label('name','Name',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("name",$subject->subjectname,array('placeholder'=>'Name of The Subject','class'=>'form-control pull-right','style'=>'clear:right;margin:10px;','readonly'));

                            echo Form::label('code','Subject Code',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("code",$subject->subjectcode,array('placeholder'=>'Short Code of the Subject to be used on Logs','class'=>'pull-right form-control ','style'=>'clear:right;margin:10px;','readonly'));

                            echo Form::label('grade','Grade',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("grade",$subject->grade,array('placeholder'=>'Grade of the Subject','class'=>'form-control pull-right','style'=>'clear:right;margin:10px;','readonly'));

                            echo "</fieldset>";
                            echo '
                            <a class=" btn btn-danger ajax-link" href="/subjects">Close</a>';
                           

                            ?>

                            </div>