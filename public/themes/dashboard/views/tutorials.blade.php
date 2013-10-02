        <div class="sortable pull-right">
            <a href="/tutorial/edit/0">
             <span class="btn btn-primary">New</span>
            </a>

        </div>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Created Date</th>
                        <th>Modified Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $tutorials = Tutorials::all();

                    foreach ($tutorials as $tutorial){
                        $subject = Subject::find($tutorial->subjectid);
                        $teacher = Teacher::find($tutorial->createdby);
                        $username = Sentry::findUserByLogin($teacher->email);
                        if(Sentry::getUser()->inGroup(Sentry::findGroupByName('admin')) || Sentry::getUser()->id == $tutorial->createdby){
                        echo "<tr>";
                        echo "<td>";
                        echo $tutorial->id;
                        echo "</td>";
                        echo "<td>";
                        echo $tutorial->name;
                        echo "</td>";
                        echo "<td>";
                        echo $subject->subjectname;
                        echo "</td>";
                        echo "<td>";
                        echo $subject->grade;
                        echo "</td>";
                        echo "<td>";
                        echo $tutorial->created_at;
                        echo "</td>";
                        echo "<td>";
                        echo $tutorial->updated_at;
                        echo "</td>";
                        echo "<td>";
                        echo $username->first_name.' '.$username->last_name;
                        echo "</td>";
                        echo "<td>";
                        if($tutorial->published){
                            echo "<a class='ajax-link' href='/tutorial/unpub/$tutorial->id/'><div class='btn btn-success'>Published</div></a>";
                        }
                        else {
                            echo "<a class='ajax-link' href='/tutorial/pub/$tutorial->id/'><div class='btn btn-warning'>Unpublished</div></a>";
                        }
                        echo "</td>";
                        echo '<td class="center">
                                    <a class="btn btn-success" href="/tutorial/view/'.$tutorial->id.'/">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="/tutorial/edit/'.$tutorial->id.'">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>';

                        $cuser = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if ($cuser->inGroup($admingroup))
                        {
                            echo '<a class="btn btn-danger" href="/tutorial/delete/'.$tutorial->id.'/">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>';
                        }
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>

            </table>
            