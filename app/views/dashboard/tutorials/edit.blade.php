<?php
$tutorial = Tutorials::find($id);
// var_dump($tutorial);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Config::get('system.sitename') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="https://dashboard.laravel.dev/"/>
    <!-- The styles -->
    <style type="text/css">      
    </style>

    <link id="bs-css" href="https://laravel.dev/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">      
    </style>
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

                            echo Form::open(array('url' => '/tutorial/edit/'.$id.'/update', 'method' => 'POST','class'=>'form-horizontal','files'=>'true'));
                            echo "<fieldset>";
                            echo Form::label('id','id',array('class'=>'pull-left','style'=>'clear:left;padding:15px;'));

                            echo Form::text('id',$id,array('disabled'=>'','class'=>'disabled pull-right','style'=>'margin:10px;'));

                            echo Form::label('title','Title',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("title",$tutorial->name,array('placeholder'=>'Title of the Tutorial','class'=>'pull-right','style'=>'clear:right;margin:10px;'));
                            
                            echo Form::label('description','Description',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));

                            echo Form::text("description",$tutorial->description,array('placeholder'=>'Describe the Tutorial Here','class'=>'pull-right','style'=>'clear:right;margin:10px;'));
                           
                            echo '
                            <div class="control-group" style="clear:left;">';
                            echo Form::label('tutorial',"Tutorial Content",array('class'=>'pull-left control-label','style'=>''));
                            echo "<div class='controls'>";
                            echo Form::textarea('tutorial',$tutorial->content,array('class'=>'cleditor pull-right','rows'=>'3','placeholder'=>"Tutorial Explanation Here",'style'=>''));
                            echo '</div>';
                            echo '</div>'; 


                            echo Form::label('published','Published',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                            if($tutorial->published === 1){
                                $checked ='checked="checked"';
                            }
                            else
                            {
                                $checked = '';
                            }
                            echo '<div style="margin:20px;position:relative;padding-top:10px;"><input 
                            data-no-uniform="true" type="checkbox" '.$checked.' name="published" id="published" class="iphone-toggle"></div>';



                            echo Form::label('attachment','Attachment',array('class'=>'pull-left','style'=>'clear:left;margin:15px;'));
                            echo Form::file('attachment', array('class'=>"pull-right",'style'=>'clear:right;margin:20px;padding-top:10px;'));
                            
                            echo "</fieldset>";

                            echo Form::submit('Save Changes',array('class'=>'btn btn-success','value'=>'submit'));
                            echo '
                            <a class="btn btn-danger" href="/tutorials">Close</a>';
                            ?>
                            </div>
                            <div class="offset2 span3">
                                <div class="control-group">
                                <label class="control-label">Created Date</label>
                                    <div class="controls">
                                        <span class="input-xlarge uneditable-input">{{ $tutorial->created_at }}</span>
                                    </div>
                                </div>
                                <label class="control-label">Updated Date</label>
                                <div class="controls">
                                        <span class="input-xlarge uneditable-input">{{ $tutorial->updated_at }}</span>
                                </div>
                                <label class="control-label">Current Attachments</label>
                                <?php
                                if(is_dir(app_path().'/attachments/tutorial-'.$id)){
                                $types = array(
                                'jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF','PDF','pdf','bmp','BMP'
                                 );
                                $folder = app_path().'/attachments/tutorial-'.$id;
                                $it = new RecursiveDirectoryIterator($folder);
                                $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                                foreach ($files as $file) {
                                    if (is_file($file)) {
                                            var_dump($file);   
                                                }
                                }
                                }
                                echo Form::close();
                                ?>

                            </div>
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
