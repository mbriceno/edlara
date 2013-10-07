                            <div class="col-xs-12 col-sm-12 col-lg-9 col-md-9 well">
                            <?php
                            $subject = Subject::find($id);
                            echo Form::open(array('url' => '/subject/edit/'.$id.'/update', 'method' => 'POST','class'=>'form-horizontal'));

                            echo "<fieldset>";
                            echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                            echo Form::text('id',$id,array('class'=>'form-control pull-right','style'=>'margin:10px;','readonly'));

                            echo Form::label('name','Name',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("name",$subject->subjectname,array('placeholder'=>'Name of The Subject','class'=>'form-control pull-right','style'=>'clear:right;margin:10px;'));

                            echo Form::label('code','Subject Code',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("code",$subject->subjectcode,array('placeholder'=>'Short Code of the Subject to be used on Logs','class'=>'pull-right form-control ','style'=>'clear:right;margin:10px;'));

                            echo Form::label('grade','Grade',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("grade",$subject->grade,array('placeholder'=>'Grade of the Subject','class'=>'form-control pull-right','style'=>'clear:right;margin:10px;'));

                            echo "</fieldset>";
                            echo Form::submit('Save Changes',array('class'=>'btn btn-success','value'=>'submit'));
                            echo '
                            <a class=" btn btn-danger ajax-link" href="/subjects">Close</a>';
                            echo Form::close();

                            ?>

                            </div>