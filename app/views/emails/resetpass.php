<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Welcome to Edlara Educational System.
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
    <h2 id="heading">Edlara Educational System.</h2>

    Hi <?php echo $fname.' '.$lname ?>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have recently requested to reset your password.

<?php 
$url =  Config::get('app.url', 'https://laravel.dev/');
echo "<a href='".$url."forgottenpass/".$reset_code.'/'.$email."'>Click Here to Activate</a>";
?>
<br>
<p>Or</p>
<p>Copy and Paste following URL in Browser</p>
<?php 

$url =  Config::get('app.url', 'https://laravel.dev/');
echo $url."forgottenpass/".$reset_code.'/'.$email;
?>

You can contact us at anytime using this email address<a href="mailto:info@edlaraedu.com">info@edlara.com</a>
<br><p style="font-size:13px;">If You have not requested this email,Kindly ignore this notification. Sorry for any inconveinience caused.</p>
<p style="align:right;">
    Thanks,<br>
    Edlara Team</p>
    </body>
</html>