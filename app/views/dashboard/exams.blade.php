<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Setting::get('system.adminsitename') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">      
    </style>
    @stylesheets('dashboard')

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
        <script src="/js/ckeditor/ckeditor.js"></script>
</head>

<body>
        {{$topmenu}}
        {{$sidebar}}
        <div class="container-fluid">
        <div class="row-fluid">                
           {{$noscript}}

                 <!-- content starts -->
            <div id="content" class="span10"> 

            <div>
        {{$breadcrumbs}}
            </div>

        <div class="sortable pull-right">
            <a href="/exam/edit/0">
             <span class="btn btn-primary">New</span>
            </a>

        </div>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
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
    <script src="js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
    <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
    <!-- transition / effect library -->
    <script src="js/bootstrap-transition.js"></script>
    <!-- alert enhancer library -->
    <script src="js/bootstrap-alert.js"></script>
    <!-- modal / dialog library -->
    <script src="js/bootstrap-modal.js"></script>
    <!-- custom dropdown library -->
    <script src="js/bootstrap-dropdown.js"></script>
    <!-- scrolspy library -->
    <script src="js/bootstrap-scrollspy.js"></script>
    <!-- library for creating tabs -->
    <script src="js/bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="js/bootstrap-tooltip.js"></script>
    <!-- popover effect library -->
    <script src="js/bootstrap-popover.js"></script>
    <!-- button enhancer library -->
    <script src="js/bootstrap-button.js"></script>
    <!-- accordion library (optional, not used in demo) -->
    <script src="js/bootstrap-collapse.js"></script>
    <!-- carousel slideshow library (optional, not used in demo) -->
    <script src="js/bootstrap-carousel.js"></script>
    <!-- autocomplete library -->
    <script src="js/bootstrap-typeahead.js"></script>
    <!-- tour library -->
    <script src="js/bootstrap-tour.js"></script>
    <!-- library for cookie management -->
    <script src="js/jquery.cookie.js"></script>
    <!-- calander plugin -->
    <script src='js/fullcalendar.min.js'></script>
    <!-- data table plugin -->
    <script src='js/jquery.dataTables.min.js'></script>

    <!-- chart libraries start -->
    <script src="js/excanvas.js"></script>
    <script src="js/jquery.flot.min.js"></script>
    <script src="js/jquery.flot.pie.min.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.min.js"></script>
    <!-- chart libraries end -->

    <!-- select or dropdown enhancer -->
    <script src="js/jquery.chosen.min.js"></script>
    <!-- checkbox, radio, and file input styler -->
    <script src="js/jquery.uniform.min.js"></script>
    <!-- plugin for gallery image view -->
    <script src="js/jquery.colorbox.min.js"></script>
    <!-- rich text editor library -->
    <script src="js/jquery.cleditor.min.js"></script>
    <!-- notification plugin -->
    <script src="js/jquery.noty.js"></script>
    <!-- file manager library -->
    <script src="js/jquery.elfinder.min.js"></script>
    <!-- star rating plugin -->
    <script src="js/jquery.raty.min.js"></script>
    <!-- for iOS style toggle switch -->
    <script src="js/jquery.iphone.toggle.js"></script>
    <!-- autogrowing textarea plugin -->
    <script src="js/jquery.autogrow-textarea.js"></script>
    <!-- multiple file upload plugin -->
    <script src="js/jquery.uploadify-3.1.min.js"></script>
    <!-- history.js for cross-browser state change on ajax -->
    <script src="js/jquery.history.js"></script>
    <!-- application script for Charisma demo -->
    <script src="js/charisma.js"></script>
    
        
</body>
</html>
