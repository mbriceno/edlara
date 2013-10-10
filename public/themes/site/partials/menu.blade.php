<nav class="navbar navbar-default" id="main-nav" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="/">Home</a>
        </li>
        <li>
            <a href="/tutorials">Tutorials</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Assessments<b class="caret"></b></a>
            <?php
            if(Sentry::check()){
               ?>
               <ul class="dropdown-menu">

                <li>
                    <a href="/assessment/submit">Submit a Assessment</a>
                </li>
                <li>
                    <a href="/assessment/update">Update a submitted Assessment</a>
                </li>
            </ul>
            <?php } ?>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                if ( ! Sentry::check()){
                    echo "Login";
                }
                else
                {
                    echo "Account";
                }
                ?>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    if ( ! Sentry::check())
                    {
                        echo "<div class='loginbox'>";
                        echo Theme::partial('loginsnippet');
                        echo "<li><a href='/forgotpass'>Forgotten Password</a></li>";
                        echo '</div>';
                    }
                    else
                    {
                        if(Sentry::getUser()->inGroup(Sentry::findGroupByName('teachers')) || Sentry::getUser()->inGroup(Sentry::findGroupByName('admin')))
                            echo "<li><a href='/dash'>Dashboard</a><li>";
                        echo "<li><a href='/profile/0'>Profile</a></li>";
                        echo "<li><a href='/logout'>Logout</a></li>";
                    }
                    ?>      
                </ul>
            </li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">INFO<b class="caret"></b></a>
               <ul class="dropdown-menu">

                <li>
                    <a href="/aboutus">About Us</a>

                </li>
                <li>
                    <a href="about/tos">Terms of Service &amp; Privacy Policy</a>

                </li>

                <li>
                    <a href="/contactus">Contact Us</a>

                </li>
            </ul>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->
</nav>

