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
                <?php
                $tutorial = Tutorials::find($id);
                ?>
                <div class="span2 offset2" id="details">
                    <label class="label pull-left">
                        Title of the Tutorial
                    </label>
                    <div class="pull-right">
                        {{$tutorial->name}}
                    </div>
                    <br>&nbsp;<br>
                    <label class="label pull-left">
                        Created By
                    </label>
                    <div class="pull-right">
                        <?php
                        $teacher = $tutorial->createdby;
                        $user = Sentry::findUserById($teacher);
                        echo $user->first_name.' '.$user->last_name;
                        ?>
                    </div>
                    <br>&nbsp;<br>
                    <label class="label pull-left">
                        Subject
                    </label>
                    <div class="pull-right">
                        <?php
                        $subjectid = $tutorial->subjectid;
                        $subject = Subject::find($subjectid);
                        echo $subject->subjectname;
                        ?>
                    </div>
                    
                    <br>&nbsp;<br>
                    

                </div>
                <div class="span8 offset2 content">
                        {{$tutorial->content}}
                    </div>
                    <div class="span3 offset3">
                    <br>&nbsp;<br>
                    <br>&nbsp;<br>
                    <br>&nbsp;<br>
                    <br>&nbsp;<br>
                    <div>
                        <?php
                        $tohash = 'tutorial-'.$tutorial->id;
                        $encrypted = Crypt::encrypt($tohash);
                        $encryptionexam = Crypt::encrypt($tohash);
                        Session::put($tohash,$encrypted);
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
                        elseif($groupname == 'students'){
                            $user = Student::findOrFail($usere->id);
                        }

                        // $user = Sentry::getUser();
                        // $student = Student::findOrFail($user->id);
                        $ssubjects = $user->extra;
                        $subjects = unserialize($ssubjects);
                        $truth = checkSubject($subjects,$tutorial->subjectid);
                        if($truth == 1 && Sentry::getUser()->inGroup(Sentry::findGroupByName('students'))){
                            if($tutorial->exams['true'] == true){
                            echo "<a href='/assessment/submit/".$tutorial->id."/".$encrypted."' class='btn btn-info'>Submit a Assessment for this Tutorial</a>";
                        }
                        ?>
                    </div>
                    <br>&nbsp;<br>
                    <br>&nbsp;<br>
                        <h4>Attachments</h4>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
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
                                             echo "<a class='btn btn-small' href='/attachments/tutorial-".$id.'/'.$filename."/download/'>Download</a>";
                                             echo "<a class='btn btn-small btn-success' href='/attachments/tutorial-".$id.'/'.$filename."/view/'>View</a>";
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
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
            $('#navbar').scrollspy();
        </script>
    </body>
</html>