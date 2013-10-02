            <div class="row well">
                <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                    <?php
                    echo Form::open(array('url' => '/tutorial/edit/'.$id.'/update', 'method' => 'post','class'=>'form-horizontal'));
                    echo "<fieldset>";
                    echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                    echo Form::text('id',$id,array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

                    echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                    echo Form::text("title","",array('placeholder'=>'Title of the Tutorial','class'=>'pull-right','style'=>'clear:right;margin:10px;'));

                    echo Form::label('description','Description',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                    echo Form::text("description","",array('placeholder'=>'Describe the Tutorial Here','class'=>'pull-right','style'=>'clear:right;margin:10px;'));

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
                           $subjectlist[$subject->id] = $subject->subjectname .' Grade '.$subject->grade;
                       }

                   }





                   echo Form::select('subject',$subjectlist,$subject->id,array('class'=>'pull-right','style'=>'clear:right;margin:10px;'));

                    echo Form::label('published','Published',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                    $checked = '';
                    echo '<div class="make-switch pull-right"><input type="checkbox" name="published" id="published" '.$checked.'></div>';             ?>
                    </div>

                   <?php
                   echo '<div class="control-group" style="clear:left;">';                   
                    echo Form::label('tutorial',"Tutorial Content",array('class'=>'pull-left control-label','style'=>''));
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-right">
                    <?php
                    echo "<div class='controls'>";
                    echo Form::textarea('tutorial',"",array('class'=>'pull-right','rows'=>'3','placeholder'=>"Tutorial Explanation Here",'style'=>'clear:right;width:65%;'));
                    echo '</div>';
                    ?><br>&nbsp;<br>
                    <?php

                    echo "</fieldset>";
                    echo Form::submit('Create',array('class'=>'btn btn-success','value'=>'submit'));
                    echo '
                    <a class="btn btn-danger" href="/tutorials">Cancel</a>';
                    echo Form::close();
                    ?>
                </div>
                <div class="offset2 span3">

                </div>
            </div>
        <div class="clearfix"></div>
<script>
 window.onload = function() {
    CKEDITOR.replace( 'tutorial' , {
        uiColor: '#568432'
    });
};
</script>