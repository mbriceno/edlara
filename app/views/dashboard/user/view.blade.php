<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Setting::get('system.adminsitename') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{Setting::get('system.dashurl')}}"/>

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">      
    </style>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
   
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
     
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);


      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Assessments');
      data.addColumn('number', 'Marks or Score Gained at the Tutorial');
      <?php
 $assessments  =DB::select(DB::raw('SELECT `title`,`marks` FROM `assessments` WHERE (`created_at` >= CURDATE() - INTERVAL 12 MONTH )AND (`studentid` = '.$id.')'));;
      echo "data.addRows([";
        foreach($assessments as $assessment){
          // var_dump($assessment);
      echo "['".$assessment->title."',".$assessment->marks."],";
  }
      echo "]);"

      ?>
     

      // Set chart options
      var options = {'title':'User Statistics over Past Exams and Assessments Submitted by Student',
                     'width':800,
                     'height':600};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
    @stylesheets('dashboard')

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
        
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
             <!--TODO: Editing Template  -->
            <div class="box span12">
                <div class="box-header well">
                    <h2><i class="icon-info-sign"></i>Edit Existing Tutorial   </h2>
                </div>
                <div class="box-content" style="display: block;">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span6">
                                <?php
                                $user = User::find($id);
                                echo "<fieldset>";
                                echo Form::label('id','ID',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));
                                echo Form::text('id',$id,array('class'=>'pull-right disabled','disabled'=>'','style'=>'margin:10px;'));
                                echo Form::label('email','e-Mail',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));
                                echo Form::text('email',$user->email,array('class'=>'pull-right disabled','disabled'=>'','style'=>'margin:10px;'));
                                echo Form::label('accountlevel','Account Level',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));
                                echo Form::select('accountlevel',['student'=>'Student','teacher'=>'Teacher'],'student',array('disabled','class'=>'disabled uneditable-input pull-right','style'=>'clear:right;margin:10px;height:30px;'));
                                echo "</fieldset>";
                                ?>
                            </div>
                            <div class="span6">
                                <?php
                            // user email
                            $email = $user->email;

                            // create some gravatarer object 
                            $url = Gravatarer::make( [
                            'email' => $email, 
                            'size' => 220, 
                            'defaultImage' => 'mm',
                            'rating' => 'g',
                            ])->url();
                            // get gravatar <img> html code
                            // $html = $gravatar->html();
                            ?>          <h3>
                            Profile Picture
                            </h3>   
                            <img alt="{{$email}}" class="pull-right" src="{{$url}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="span12">

    <div class="demo-container">
      <div id="placeholder" class="demo-placeholder"></div>
    </div>
                  <h2>Statistics</h2>
                  <div class="tabbable"> <!-- Only required for left/right tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Assessments</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                  <div id="chart_div" style="width:400; height:300"></div>
                </div>                
              </div>
            </div>
                </div>
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
