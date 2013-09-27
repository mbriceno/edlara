<!doctype html>
<html>
    <head>
        <title>User - {{User::find($id)->first_name.' '.User::find($id)->last_name }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
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
      data.addColumn('number', 'Score');
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

    </head>
    <body>

        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>
                <div class="span3 offset2">
                <?php
                $user = User::find($id);
                $userdata = Student::find($id);
                $userstram = 'student';
                if($userdata == NULL){
                    $userdata = Teacher::find($id);
                    $userstream = 'teacher';
                }
                else{
                    $userdata;
                }
                ?>
                    <div class="pull-left">
                        First Name -
                    </div>
                    <div class="pull-right">
                        {{$user->first_name}}
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Last Name -
                    </div>
                    <div class="pull-right">
                        {{$user->last_name}}
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Email -
                    </div>
                    <div class="pull-right">
                        <?php
                        if(Sentry::getUser()->id == $id || Sentry::getUser()->inGroup(Sentry::findGroupByName('admin')))
                        {
                            echo $user->email;
                        }
                        else 
                        {
                            echo "Email is only visible to Admin and User whom it belongs to.";
                        }
                        ?>
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Date Of Birth
                    </div>
                    <div class="pull-right">
                        <?php
                        if($userdata !== NULL){
                            echo $userdata->dob;
                        }
                        ?>
                    </div><br>

                </div>
                <div class="span3">
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
?>      <h3>
Profile Picture
</h3> 
      <img alt="{{$email}}" class="pull-right" src="{{$url}}"/>
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
            </div>
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
       
    </body>
</html>