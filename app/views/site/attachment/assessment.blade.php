<!doctype html>
<html>
    <head>
        <title>{{ Setting::get('system.schoolname') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>
                <div class=span12>
                	<?php
                	switch($type){
                		case 'jpg':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'JPG':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'png':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'PNG':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'gif':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'GIF':
                			echo "<img src='".Setting::get('app.url')."attachment/assessment-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                	}
                	?>
                </div>
            </div>
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
            $('#navbar').scrollspy();
        </script>
    </body>
</html>