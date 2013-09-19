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
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $tutorials = Tutorials::all();

                    foreach ($tutorials as $tutorial){
                        if($tutorial->published == 1){


                        $subject = Subject::find($tutorial->subjectid);
                        $teacher = Teacher::find($tutorial->createdby);
                        $username = Sentry::findUserByLogin($teacher->email);
                        echo "<tr>";
                        echo "<td>";
                        echo $tutorial->id;
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='/tutorial/".$tutorial->id."'>$tutorial->name";
                        echo "</td>";
                        echo "<td>";
                        echo $subject->subjectname;
                        echo "</td>";                     
                        echo "</tr>";
                        }
                    }
                    ?>

                </tbody>

                </table>
                </span>
            </div>
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