
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
                $students = Student::all();
                foreach ($students as $student){
                    $user = Sentry::findUserByLogin($student->email);
                    echo "<tr>";
                    echo "<td>";
                    echo $student->user_id;
                    echo "</td>";
                    echo "<td>";
                    echo $user->first_name;
                    echo "</td>";
                    echo "<td>";
                    echo $user->last_name;
                    echo "</td>";
                    echo "<td>";
                    echo $student->dob;
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
                                    <a class="btn btn-success" href="/user/'.$user->id.'/view">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a></td>';
                                
                    echo "</tr>";
                    
                }



            ?>
                    </tbody>
                </table>