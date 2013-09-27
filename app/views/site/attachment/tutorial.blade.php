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
                    // var_dump($type);
                	switch($type){
                		case 'jpg':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'JPG':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'png':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'PNG':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'gif':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break;
                		case 'GIF':
                			echo "<img src='".Setting::get('app.url')."tutorial-".$id."/".$attachment."/download/' height='auto' width='auto' />";
                			break; 
                        case 'pdf':
                            echo '<object data="'.Setting::get('app.url')."attachments/tutorial-".$id."/".$attachment.'/download" type="application/pdf" width="100%" height="100%">
 
                                <p>It appears you don\'t have a PDF plugin for this browser.
                                No biggie... you can <a href="'.Setting::get('app.url')."attachments/tutorial-".$id."/".$attachment.'/download">click here to
                                download the PDF file.</a></p>
  
                            </object>';
                            break;
                            case 'PDF':
                                echo '<object data="'.Setting::get('app.url')."attachments/tutorial-".$id."/".$attachment.'/download" type="application/pdf" width="100%" height="100%"><p>It appears you don\'t have a PDF plugin for this browser. No biggie... you can <a href="'.Setting::get('app.url')."attachment/tutorial-".$id."/".$attachment.'/download">click here to download the PDF file.</a></p></object>';
                                break;           
                            case 'swf':
                                echo "<embed src='".Setting::get('app.url')."attachments/tutorial-".$id."/".$attachment.'/download\' />';             
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