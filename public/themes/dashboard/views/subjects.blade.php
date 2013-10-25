<?php

defined('ROOT' )|| die('Restricted Access');

?>  <div class="sortable pull-right">
            <a href="/subject/edit/0/create">
             <span class="btn btn-primary">New</span>
            </a>
        </div>

<table id="subjects" class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Subject Name</th>
                        <th>Grade</th>
                        <th>Subject Code</th>
                        <th>Created Date</th>
                        <th>Modified Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $subjects = Subject::all();

                    foreach ($subjects as $subject){
                        
                        echo "<tr>";
                        echo "<td style='width:5%;'>";
                        echo $subject->id;
                        echo "</td>";
                        echo "<td style='width:auto;'>";
                        echo $subject->subjectname;
                        echo "</td>";
                        echo "<td style='width:auto;'>";
                        echo $subject->grade;
                        echo "</td>";
                        echo "<td style='width:auto;'>";
                        echo $subject->subjectcode;
                        echo "</td>";
                        echo "<td>";
                        echo $subject->created_at;
                        echo "</td>";
                        echo "<td>";
                        echo $subject->updated_at;
                        echo "</td>";
                        
                        echo '<td>
                        <a class="btn btn-success" href="/subject/edit/'.$subject->id.'/view"><i class="icon-zoom-in icon-white"></i> View</a><a class="btn btn-info" href="/subject/edit/'.$subject->id.'/update"><i class="icon-edit icon-white"></i> Edit</a><a class="btn btn-warning" href="/subject/edit/'.$subject->id.'/delete"><i class="icon-trash icon-white"></i> Delete</a>';
                        
                                    
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>

            </table>
            </div>