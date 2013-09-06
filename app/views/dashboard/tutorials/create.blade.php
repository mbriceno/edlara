<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Config::get('system.sitename') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<base href="https://laravel.dev/">

    <!-- The styles -->
    <style type="text/css">      
    </style>

    <link id="bs-css" href="https://laravel.dev/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">      
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/charisma-app.css" rel="stylesheet">
    <link href="/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href='/css/fullcalendar.css' rel='stylesheet'>
    <link href='/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
    <link href='/css/chosen.css' rel='stylesheet'>
    <link href='/css/uniform.default.css' rel='stylesheet'>
    <link href='/css/colorbox.css' rel='stylesheet'>
    <link href='/css/jquery.cleditor.css' rel='stylesheet'>
    <link href='/css/jquery.noty.css' rel='stylesheet'>
    <link href='/css/noty_theme_default.css' rel='stylesheet'>
    <link href='/css/elfinder.min.css' rel='stylesheet'>
    <link href='/css/elfinder.theme.css' rel='stylesheet'>
    <link href='/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='/css/opa-icons.css' rel='stylesheet'>
    <link href='/css/uploadify.css' rel='stylesheet'>


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
         
                 <!-- content starts -->
            <div id="content" class="span10"> 

            <div>
        {{$breadcrumbs}}
            </div>

            <!--TODO: Editing Template  -->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class="icon-info-sign"></i>Create a New Tutorial</h2>
                    </div>
                    <div class="box-content" style="display: block;">
                        <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span6">
                            <?php

                            echo Form::open(array('url' => '/tutorial/edit/'.$id.'/update', 'method' => 'post','class'=>'form-horizontal'));
                            echo "<fieldset>";
                            echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                            echo Form::text('id',$id,array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

                            echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("title","",array('placeholder'=>'Title of the Tutorial','class'=>'pull-right','style'=>'clear:right;margin:10px;'));

                            echo Form::label('description','Description',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("description","",array('placeholder'=>'Describe the Tutorial Here','class'=>'pull-right','style'=>'clear:right;margin:10px;'));

                            echo '
                            <div class="control-group" style="clear:left;">';
                            echo Form::label('tutorial',"Tutorial Content",array('class'=>'pull-left control-label','style'=>''));
                            echo "<div class='controls'>";
                            echo Form::textarea('tutorial',"",array('class'=>'cleditor pull-right','rows'=>'3','placeholder'=>"Tutorial Explanation Here",'style'=>''));
                            echo '</div>';
                            echo '</div>';
                            echo Form::label('attachment','Attachment',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                            echo Form::file('attachment', array('class'=>"pull-right",'style'=>'clear:right;margin:25px;'));
                            
                            echo "</fieldset>";
                            echo Form::submit('Create',array('class'=>'','value'=>'submit'));
                            echo Form::close();
                            ?>
                            </div>
                            <div class="offset2 span3">
                                DISPLAY
                            </div>
                        </div>
                    </div>
                        <div class="clearfix"></div>
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
    <script src="/js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
    <script src="/js/jquery-ui-1.8.21.custom.min.js"></script>
    <!-- transition / effect library -->
    <script src="/js/bootstrap-transition.js"></script>
    <!-- alert enhancer library -->
    <script src="/js/bootstrap-alert.js"></script>
    <!-- modal / dialog library -->
    <script src="/js/bootstrap-modal.js"></script>
    <!-- custom dropdown library -->
    <script src="/js/bootstrap-dropdown.js"></script>
    <!-- scrolspy library -->
    <script src="/js/bootstrap-scrollspy.js"></script>
    <!-- library for creating tabs -->
    <script src="/js/bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="/js/bootstrap-tooltip.js"></script>
    <!-- popover effect library -->
    <script src="/js/bootstrap-popover.js"></script>
    <!-- button enhancer library -->
    <script src="/js/bootstrap-button.js"></script>
    <!-- accordion library (optional, not used in demo) -->
    <script src="/js/bootstrap-collapse.js"></script>
    <!-- carousel slideshow library (optional, not used in demo) -->
    <script src="/js/bootstrap-carousel.js"></script>
    <!-- autocomplete library -->
    <script src="/js/bootstrap-typeahead.js"></script>
    <!-- tour library -->
    <script src="/js/bootstrap-tour.js"></script>
    <!-- library for cookie management -->
    <script src="/js/jquery.cookie.js"></script>
    <!-- calander plugin -->
    <script src='/js/fullcalendar.min.js'></script>
    <!-- data table plugin -->
    <script src='/js/jquery.dataTables.min.js'></script>

    <!-- chart libraries start -->
    <script src="/js/excanvas.js"></script>
    <script src="/js/jquery.flot.min.js"></script>
    <script src="/js/jquery.flot.pie.min.js"></script>
    <script src="/js/jquery.flot.stack.js"></script>
    <script src="/js/jquery.flot.resize.min.js"></script>
    <!-- chart libraries end -->

    <!-- select or dropdown enhancer -->
    <script src="/js/jquery.chosen.min.js"></script>
    <!-- checkbox, radio, and file input styler -->
    <script src="/js/jquery.uniform.min.js"></script>
    <!-- plugin for gallery image view -->
    <script src="/js/jquery.colorbox.min.js"></script>
    <!-- rich text editor library -->
    <script src="/js/jquery.cleditor.min.js"></script>
    <!-- notification plugin -->
    <script src="/js/jquery.noty.js"></script>
    <!-- file manager library -->
    <script src="/js/jquery.elfinder.min.js"></script>
    <!-- star rating plugin -->
    <script src="/js/jquery.raty.min.js"></script>
    <!-- for iOS style toggle switch -->
    <script src="/js/jquery.iphone.toggle.js"></script>
    <!-- autogrowing textarea plugin -->
    <script src="/js/jquery.autogrow-textarea.js"></script>
    <!-- multiple file upload plugin -->
    <script src="/js/jquery.uploadify-3.1.min.js"></script>
    <!-- history.js for cross-browser state change on ajax -->
    <script src="/js/jquery.history.js"></script>
    <!-- application script for Charisma demo -->
    <script src="/js/charisma.js"></script>
    
        
</body>
</html>
