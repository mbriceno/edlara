<div class='row'>
<div class="col-md-10 offset-md-2">
        <table id="assessments" class="table table-striped table-bordered bootstrap-datatable datatable">
         <thead>
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Subject</th>
                <th>Submitted To</th>
                <th>Related Tutorial</th>
                <th>Submitted On</th>
                <th>Last Updated</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $assessments = Assessments::where('studentid','=',Sentry::getUser()->id)->get();
            foreach ($assessments as $assessment){

                $subjectid = $assessment->subjectid;
                $subject = Subject::find($subjectid);
                $teacherid = $assessment->teacherid;
                $teacher = User::find($teacherid);
                $tutorialid = $assessment->tutorialid;
                $tutorial = Tutorials::find($tutorialid);
                echo "<tr>";
                echo "<td>";
                echo $assessment->id;
                echo "</td>";
                echo "<td>";
                echo "<a href='/assessment/update/".$assessment->id."'>$assessment->title";
                echo "</td>";
                echo "<td>";
                echo $subject->subjectname;
                echo "</td>";
                echo "<td>";
                echo $teacher->first_name.' '.$teacher->last_name;
                echo "</td>";
                echo "<td>";
                echo $tutorial->name;
                echo "</td>";
                echo "<td>";
                echo $tutorial->created_at;
                echo "</td>";
                echo "<td>";
                echo $tutorial->updated_at;
                echo "</td>";
                echo "<td>";
                echo $assessment->marks;
                echo "</td>";
                echo "</tr>";
            }

            ?>

        </tbody>

    </table>
</span>
</div>
</div>
