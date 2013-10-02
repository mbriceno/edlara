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
        <link rel="stylesheet" href="/lib/effeckt/css/effeckt.autoprefixed.css">

        <link rel="stylesheet" type="text/css" href="/lib/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/lib/system/style.css">
        <link rel="stylesheet" type="text/css" href="/lib/datatables/css/jquery.dataTables.css">
    </head>
    <body>      
    <nav class="navbar navbar-fixed-top navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">JHCSS</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="tosite"><a href="#">Visit Site</a></li>          
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class='user'>
                <div class="btn-group adminbtn">
                    <button type="button" class="btn">
                        <i class="glyphicon glyphicon-user"></i> John Doe
                    </button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret black-caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
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
    <script>window.jQuery || document.write('<script src="/lib/js/effeckt/libs/jquery-2.0.3.min.js"><\/script>')</script>
<script type="text/javascript">
   $(document).ready(function(){
    $('li a').each(function(index) {
        if(this.href.trim() == window.location)
            $(this).parent().addClass("active");
    });
});
</script>
    <!-- demo -->
    <script src="/lib/effeckt/js/demo/demo.js"></script>

    <!-- Individual module JS files here -->
    <!-- Should we combine or not combine? -->
    <!-- Should we provide minified versions? -->
    <script src="/lib/effeckt/js/Effeckt.js"></script>
    <script src="/lib/effeckt/js/modules/modals.js"></script>
    <script src="/lib/effeckt/js/modules/buttons.js"></script>
    <script src="/lib/effeckt/js/modules/list-items.js"></script>
    <script src="/lib/effeckt/js/modules/off-screen-nav.js"></script>
    <script src="/lib/effeckt/js/modules/page-transitions.js"></script>
    <script src="/lib/effeckt/js/modules/list-scroll.js"></script>
    <script src="/lib/effeckt/js/modules/tabs.js"></script>
    <script src="/lib/effeckt/js/modules/positional-modals.js"></script>

    <!-- ideally should kick this off in the demo js file itself -->
    <script>
      stroll.bind('.effeckt-demo-list-scroll ul');
      
      
    </script>

            <script src="/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
    $('.datatable').dataTable({
        "sDom": "<'row'<'col-xs-5 col-sm-5 col-md-5'l><'col-xs-5 col-sm-5 col-md-5'f>r>t<'row'<'col-xs-5 col-sm-5 col-md-5'i><'col-xs-5 col-sm-5 col-md-5'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ {{Theme::place('Type','Tutorials')}} per page"
            }
       
    } );
});
            </script>
    </body>

</html>