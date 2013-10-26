<?php

defined('ROOT' )|| die('Restricted Access');

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{Theme::place('title')}}</title>
        <meta name="description" content="HTML5 Admin Template">
        <meta name="author" content="Gnanakeethan Balasubramaniam">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap-cerulean.min.css">

        <link rel="stylesheet" type="text/css" href="/lib/system/main.css">

        <link rel="stylesheet" type="text/css" href="/lib/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/system/style.css">
        <link rel="stylesheet" type="text/css" href="/lib/datatables/css/jquery.dataTables.css">
        {{Theme::asset()->styles()}}
        {{Theme::asset()->scripts()}}
    </head>
    <body> 
    <div id="top"></div>    
    <nav class="navbar navbar-fixed-top navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">{{Setting::get('system.schoolname')}}</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="tosite"><a href="{{Setting::get('app.url')}}">Visit Site</a></li>          
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class='user'>
                <div class="btn-group adminbtn">
                    <button type="button" class="btn">
                        <i class="glyphicon glyphicon-user"></i> 
                        <?php
                        $user = Sentry::getUser();
                        ?>
                        {{$user->first_name}} {{$user->last_name}}
                    </button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret black-caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                    if(Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){
                        echo "<li><a href='/clearcache'>Clear Cache</a></li>";
                    }
                    ?>
                    <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>           
        <form action="/" class="navbar-form navbar-right" role="search">
          <div class="form-group">
            <input id="search" type="text" class="form-control" placeholder="Search">
            <input type="submit" class="hidden">
          </div>
        </form>    
      </div><!-- /.navbar-collapse -->
    </nav>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 hidden-sm hidden-md hidden-lg">

                    {{Theme::breadcrumb()->render()}}
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                   {{ Theme::widget('sidebar')->render()}}
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 hidden-xs">
                    {{Theme::breadcrumb()->render()}}
            </div>
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div class="container">
                        {{Theme::place('content')}}
                </div>
            </div>
        </div>
    </div>
  

    
    <!-- libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
     <script>window.jQuery || document.write('\<script src\=\"\/js\/jquery\-2\.0\.2\.min.js\"\>\<\/script\>')</script>
<script type="text/javascript">
   $(document).ready(function(){
    $('li a').each(function(index) {
        if(this.href.trim() == window.location)
            $(this).parent().addClass("active");
    });
});
</script>

 {{Theme::asset()->container('footer')->scripts()}}
    
            <script src="/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
            
            </script>
        
   {{Theme::asset()->container('datatable')->scripts()}}
    </body>

</html>