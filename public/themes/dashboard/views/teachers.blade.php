
             <table id="datatable" class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $teachers = Teacher::all();
                foreach ($teachers as $teacher){
                    $user = Sentry::findUserByLogin($teacher->email);
                    echo "<tr>";
                    echo "<td>";
                    echo $teacher->user_id;
                    echo "</td>";
                    echo "<td>";
                    echo $user->first_name;
                    echo "</td>";
                    echo "<td>";
                    echo $user->last_name;
                    echo "</td>";
                    echo "<td>";
                    echo $teacher->dob;
                    echo "</td>";
                    echo "<td class='center'>";
                                if($user->activated){
                                    echo "<span class='label label-success'>Activated</span>";
                                }
                                else
                                {
                                    echo "<span class='label label-failure'>Not Activated</span>";
                                }
                                echo "</td>";
                                echo '<td class="center">
                                    <a class="btn btn-success ajax-link" href="/user/'.$user->id.'/view">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="/user/'.$user->id.'/edit">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>
                                    <a class="btn btn-danger" href="/user/'.$user->id.'/delete">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>
                                    </td>';
                    echo "</tr>";
                    
                }



            ?>
                    </tbody>
                </table>