<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Welcome to <?php Setting::get('system.schoolname') ?> Educational System.
        </title>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"/>
        <style type="text/css">  
        @import url(http://fonts.googleapis.com/css?family=Metamorphous);
        h2#heading{
            font-family:'Metamorphous';
            color: #ccddss;
        }
        </style>
    </head>
    <body>
        <h2 id="heading">Update from<?php Setting::get('system.schoolname') ?>  Educational System.</h2>

    Hi <?php echo $fname.' '.$lname ?>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have recently joined in our Online Educational Programme.
This is a Update corresponding to your activity on our system.
<h5>A New Assessment has been Submitted for your Tutorial <?php echo $tutorial ?></h5>
Details of Submission:
<ul>
    <li>Submitted By :<?php echo $submittedby ?></li>
    <li>Submitted on:<?php echo $submittedon ?></li>
    <li>Review this assessment here via Dashboard:<a href="<?php echo Setting::get('app.url')?>dash"/>Dashboard</a></li>
<ul>

    </body>
</html>