 <div class="navbar">
    <div class="navbar-inner"  id="main-nav">
        <div class="container-fluid">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

                    <!-- Everything you want hidden at 940px or less, place within here -->

                <div class="nav-collapse collapse">
                        <!-- .nav, .navbar-search, .navbar-form, etc -->
                    <ul class="nav">
                        <li class="active">
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="/#gettingstarted">Getting Started</a>
                        </li>
                        <li>
                            <a href="/#aboutus">About Us</a>
                        </li>
                        <li>
                            <a href="/#contactus">Contact Us</a>
                        </li>
                        <li>
                            <a href="/tutorials">Tutorials</a>
                        </li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Assessments<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/assessment/submit">Submit a Assessment</a>
                                </li>
                                <li>
                                    <a href="/assessment/update">Update a submitted Assessment</a>
                                </li>
                            </ul>
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
                                    echo $loginsnippet;                                    
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
                </ul>
            </div>
        </div>
    </div>
</div>