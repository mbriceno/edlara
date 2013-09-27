<!doctype html>
<html>
    <head>
        <title>{{ Setting::get('system.schoolname') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
        <link href="/css/jquery-ui-1.8.21.custom.css" rel='stylesheet'/>
        <style type="text/css">
        div.dataTables_length label {
    float: left;
    text-align: left;
}
 
div.dataTables_length select {
    width: 75px;
    display: inline-block;
    position:relative;
}
 
div.dataTables_filter label {
    float: right;
display: inline-block;
}
 
div.dataTables_info {
    padding-top: 8px;
}
 
div.dataTables_paginate {
    float: right;
    margin: 0;
}
 
table {
    margin: 1em 0;
}

        </style>
    </head>
    <body>
        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>
                <span class="span12">
                <table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">
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
                        echo $tutorial->marks;
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    ?>

                </tbody>

                </table>
                </span>
            </div>
        </div>
        
        <div id='footer' class="pull-right" style="padding:20px;margin:20px;clear:right;">
            {{Setting::get('system.schoolname')}} &copy; {{date('Y')}}
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')

    <script src='/js/jquery.dataTables.min.js'></script>
        <script type="text/javascript">
            $('#navbar').scrollspy();
                //datatable
                $(document).ready(function() {
    $('#example').dataTable({
                "bJQueryUI": true,
        "sDom": "<'row'<'span4 offset1'l><'span4'f>r>t<'row'<'span4 offset1'i><'span4'p>>"
    });

} );
   
        </script>
    </body>
</html>