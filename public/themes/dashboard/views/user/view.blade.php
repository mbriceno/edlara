<?php

defined('ROOT' )|| die('Restricted Access');

?>    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
      data.addColumn('number', 'Marks or Score Gained at the Exam or Assessment');
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
<div class="row"><div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
