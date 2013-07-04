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
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Getting Started</a>
                        </li>
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                        <li>
                            <a href="#">Tutorials</a>
                        </li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Exams<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">How to do the Online Exams</a>
                                </li>
                                <li>
                                    <a href="#">Benefits of doing e-Exams</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li  class="divider"></li>
                                <li>
                                    <a href="#">Separated link</a>
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
                                    echo '</div>';
                                }
                                else
                                {
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