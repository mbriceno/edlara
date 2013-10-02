<div class="sortable pull-right">
            <a href="/exam/edit/0">
             <span class="btn btn-primary">New</span>
            </a>

        </div>
            <table id="datatable" class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $exams = Exams::all();
                    foreach ($exams as $exam){
                        if($exam->createdby == Sentry::getUser()->id || Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){
                            echo "<tr>";
                            echo "<td>";                        
                            echo $exam->id;
                            echo "</td>";
                            echo "<td>";
                            echo $exam->title;
                            echo "</td>";
                            echo "<td>";
                            echo Subject::find($exam->subjectid)->subjectname;
                            echo "</td>";
                            echo "<td>";
                            echo Subject::find($exam->subjectid)->grade;
                            echo "</td>";
                            echo '<td class="center">
                                    <a class="btn btn-success" href="/exam/view/'.$exam->id.'/">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="/exam/edit/'.$exam->id.'">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>';

                        $cuser = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if ($cuser->inGroup($admingroup))
                        {
                            echo '<a class="btn btn-danger" href="/exam/delete/'.$exam->id.'/">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>';
                        }
                            echo "</td></tr>";
                        }
                    }


                    ?>
                </tbody>
            </table>