<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Setting::get('system.adminsitename') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <base href="{{Setting::get('system.dashurl')}}"/>

    <!-- The styles -->
    <style type="text/css">      
    </style>

    <link id="bs-css" href="https://laravel.dev/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">      
    </style>
    @stylesheets('dashboard')


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
        {{$topmenu}}
        {{$sidebar}}
        <div class="container-fluid">
        <div class="row-fluid">                
         
                 <!-- content starts -->
            <div id="content" class="span10"> 

            <div>
        {{$breadcrumbs}}
            </div>

            <!--TODO: Editing Template  -->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class="icon-info-sign"></i>Create a New Exam</h2>
                    </div>
                    <div class="box-content" style="display: block;">
                        <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12">

                            <?php
                            if($errors->first()){
                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first();                            
                            echo "</div>";
                        }
                            echo Form::open(array('url' => '/exam/edit/'.$id.'', 'method' => 'post','class'=>'form-horizontal'));
                            echo "<fieldset>";
                            echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                            echo Form::text('id',$id,array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

                            echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("title",Input::old('title',''),array('placeholder'=>'Title of the Tutorial','class'=>'pull-right','style'=>'clear:right;margin:10px;'));                           

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
                                
                            }
                            



                            
                            echo Form::select('subject',$subjectlist,$subject->id,array('class'=>'pull-right','style'=>'clear:right;margin:10px;'));
                            echo '
                            <div class="control-group" style="clear:left;">';
                            echo "<div id='exams'>";
                            $qucount = Input::old('questioncount',5);
                            for($qc=1;$qc<=$qucount;$qc++){
                                echo '<div id="examdata"><label for="examdata">MCQ Question '.$qc.'</label>
        <input id="examdata" name="question_'.$qc.'" placeholder="Place the MCQ Question '.$qc.' Here" type="text" value="'.Input::old('question_'.$qc).'" style="width:50%;" required><br>&nbsp;<br>&nbsp;

    <div id="uniform-examdata" class="checker"><span><input style="opacity: 0;" id="examdata" name="checkbox_'.$qc.'[]" value="1" type="checkbox"></span></div>
    <input name="checkbox_'.$qc.'_1" placeholder="Place the Choice 1 here" type="text" value="'.Input::old('checkbox_'.$qc.'_1').'" required>

    <div id="uniform-examdata" class="checker"><span><input style="opacity: 0;" id="examdata" name="checkbox_'.$qc.'[]" value="2" type="checkbox"></span></div>
    <input name="checkbox_'.$qc.'_2" placeholder="Place the Choice 2 here" type="text" value="'.Input::old('checkbox_'.$qc.'_2').'" required>

    <div id="uniform-examdata" class="checker"><span><input style="opacity: 0;" id="examdata" name="checkbox_'.$qc.'[]" value="3" type="checkbox"></span></div>
    <input name="checkbox_'.$qc.'_3" placeholder="Place the Choice 3 here" type="text" value="'.Input::old('checkbox_'.$qc.'_3').'" required>

    <div id="uniform-examdata" class="checker"><span><input style="opacity: 0;" id="examdata" name="checkbox_'.$qc.'[]" value="4" type="checkbox"></span></div>
    <input name="checkbox_'.$qc.'_4" placeholder="Place the Choice 4 here" type="text" value="'.Input::old('checkbox_'.$qc.'_4').'" required><br>&nbsp;<br>&nbsp;';
if($qc >= 6){
    echo '<a href="#" id="removeMCQ">Remove</a>';
}
  echo   '<br><input name="checkbox_'.$qc.'[]" value="0" type="hidden">
</div>';
                            }
                            echo '<input id="questioncount" name="questioncount" type="hidden" value="'.--$qc.'">';
                            ?>
                           
                           </div>
<a href="#" class="btn btn-success" id="addMCQ">Add Another MCQ Question</a></div> 
                            <?php
                            //Need to insert JSON Creator
                            echo '</div>';
                           

                             
                            echo "</fieldset>";
                            echo Form::submit('Create',array('class'=>'btn btn-success','value'=>'submit'));
                            echo '
                            <a class="btn btn-danger" href="/exams">Cancel</a>';
                            echo Form::close();
                            ?>
                            </div>
                        </div>
                    </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
          
            <!-- content ends -->
            </div><!--/#content.span10-->
        </div><!--/fluid-row-->
                
        <hr>

        <footer>
            <p class="pull-left">&copy; Gnanakeethan Balasubramaniam 2013</p>
        </footer>
        
    </div><!--/.fluid-container-->
    <!-- external javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery -->
    <script src="/js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
    <script src="/js/jquery-ui-1.8.21.custom.min.js"></script>
    <!-- transition / effect library -->
    <script src="/js/bootstrap-transition.js"></script>
    <!-- alert enhancer library -->
    <script src="/js/bootstrap-alert.js"></script>
    <!-- modal / dialog library -->
    <script src="/js/bootstrap-modal.js"></script>
    <!-- custom dropdown library -->
    <script src="/js/bootstrap-dropdown.js"></script>
    <!-- scrolspy library -->
    <script src="/js/bootstrap-scrollspy.js"></script>
    <!-- library for creating tabs -->
    <script src="/js/bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="/js/bootstrap-tooltip.js"></script>
    <!-- popover effect library -->
    <script src="/js/bootstrap-popover.js"></script>
    <!-- button enhancer library -->
    <script src="/js/bootstrap-button.js"></script>
    <!-- accordion library (optional, not used in demo) -->
    <script src="/js/bootstrap-collapse.js"></script>
    <!-- carousel slideshow library (optional, not used in demo) -->
    <script src="/js/bootstrap-carousel.js"></script>
    <!-- autocomplete library -->
    <script src="/js/bootstrap-typeahead.js"></script>
    <!-- tour library -->
    <script src="/js/bootstrap-tour.js"></script>
    <!-- library for cookie management -->
    <script src="/js/jquery.cookie.js"></script>
    <!-- calander plugin -->
    <script src='/js/fullcalendar.min.js'></script>
    <!-- data table plugin -->
    <script src='/js/jquery.dataTables.min.js'></script>

    <!-- chart libraries start -->
    <script src="/js/excanvas.js"></script>
    <script src="/js/jquery.flot.min.js"></script>
    <script src="/js/jquery.flot.pie.min.js"></script>
    <script src="/js/jquery.flot.stack.js"></script>
    <script src="/js/jquery.flot.resize.min.js"></script>
    <!-- chart libraries end -->

    <!-- select or dropdown enhancer -->
    <script src="/js/jquery.chosen.min.js"></script>
    <!-- checkbox, radio, and file input styler -->
    <script src="/js/jquery.uniform.min.js"></script>
    <!-- plugin for gallery image view -->
    <script src="/js/jquery.colorbox.min.js"></script>
    <!-- rich text editor library -->
    <script src="/js/jquery.cleditor.min.js"></script>
    <!-- notification plugin -->
    <script src="/js/jquery.noty.js"></script>
    <!-- file manager library -->
    <script src="/js/jquery.elfinder.min.js"></script>
    <!-- star rating plugin -->
    <script src="/js/jquery.raty.min.js"></script>
    <!-- for iOS style toggle switch -->
    <script src="/js/jquery.iphone.toggle.js"></script>
    <!-- autogrowing textarea plugin -->
    <script src="/js/jquery.autogrow-textarea.js"></script>
    <!-- multiple file upload plugin -->
    <script src="/js/jquery.uploadify-3.1.min.js"></script>
    <!-- history.js for cross-browser state change on ajax -->
    <script src="/js/jquery.history.js"></script>
    <!-- application script for Charisma demo -->
    <script src="/js/charisma.js"></script>
    
        
<script type="text/javascript">
    $(function() {
        var exams = $('#exams');
        var i = $('#exams div#examdata').size()+1;
        
        $('#addMCQ').live('click', function() {
                $(this).parents('#questioncount').remove();
                $('<div id="examdata"><label for="examdata">MCQ Question ' + i + '</label><input type="text" required="" style="width:50%;" placeholder="Place the MCQ Question ' + i + ' Here" value="" name="question_' + i + '" id="examdata" required><br>&nbsp;<br>&nbsp;<div class="checker" id="uniform-examdata"><span><div class="checker" id="uniform-examdata"><span><input type="checkbox" value="1" name="checkbox_' + i + '[]" id="examdata" style="opacity: 0;"></span></div></span></div><input type="text" value="" placeholder="Place the Choice 1 here" name="checkbox_' + i + '_1" required><div class="checker" id="uniform-examdata"><span><div class="checker" id="uniform-examdata"><span><input type="checkbox" value="2" name="checkbox_' + i + '[]" id="examdata" style="opacity: 0;"></span></div></span></div><input type="text" value="" placeholder="Place the Choice 2 here" name="checkbox_' + i + '_2" required><div class="checker" id="uniform-examdata"><span><div class="checker" id="uniform-examdata"><span><input type="checkbox" value="3" name="checkbox_' + i + '[]" id="examdata" style="opacity: 0;"></span></div></span></div><input type="text" value="" placeholder="Place the Choice 3 here" name="checkbox_' + i + '_3" required><div class="checker" id="uniform-examdata"><span><div class="checker" id="uniform-examdata"><span><input type="checkbox" value="4" name="checkbox_' + i + '[]" id="examdata" style="opacity: 0;"></span></div></span></div><input type="text" value="" placeholder="Place the Choice 4 here" name="checkbox_' + i + '_4" required><br>&nbsp;<br>&nbsp;<br><input type="hidden" value="0" name="checkbox_' + i + '[]"><a href="#" id="removeMCQ">Remove</a></div><input id="questioncount" name="questioncount" type="hidden" value="' + i + '">').appendTo(exams);
                i++;
                return false;
        });
        
        $('#removeMCQ').live('click', function() { 
                if( i > 5 ) {
                        $(this).parents('div#examdata').remove();
                        $(this).parents('#questioncount').remove();

                        i--;

                        $('<input id="questioncount" name="questioncount" type="hidden" value="' + i + '">').appendTo(exams);
                }
                return false;
        });
});

</script>
</body>
</html>
