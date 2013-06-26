<!doctype html>
<html>
    <head>
        <title>Edlara</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        <div class="container-fluid" id='top-heading'>
            <div class="row-fluid" >
                <div id="clouds">
                    <div class="cloud x1"></div>
                    <div class="cloud x2"></div>
                    <div class="cloud x3"></div>
                    <div class="cloud x4"></div>
                    <div class="cloud x5"></div>
                </div>
                <span class="brand-name" id='top-header'>EdLara</span>
            </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner"  id="main-nav">
                <div class="container">

                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>

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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php
                                                                                
                                        echo Form::open(array('url' => 'login', 'method' => 'post'));

                                        //Echo FORM Label for Email address
                                        echo Form::label('email', 'E-Mail Address', array('class' => 'lbl-email-addr-login'));

                                        //Echo FORM Element for Email address
                                        echo Form::text('email', "", array('class' => 'email-addr-login', 'placeholder' => 'johndoe@example.com', 'autocomplete' => 'off'));

                                        //Echo FORM Label for Password address
                                        echo Form::label('password', 'Password', array('class' => 'lbl-pwd-login'));

                                        //Echo FORM Element for Password
                                        echo Form::password('password', "", array('class' => 'pwd-login', 'placeholder' => 'Password', 'autocomplete' => 'off'));

                                        echo "<br>";

                                        //Echo FORM Element for Submit
                                        echo Form::submit('Login', array('class' => 'btn btn-large btn-info'));

                                        echo Form::token();
                                        echo Form::close();
                                        ?>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="parallax">
            <section id="first" class="plx-story">
                <article>
                    <p>
                        Test
                    </p>
                </article>
            </section>
            <section id="second" class="plx-story">
                <article>
                    <p>
                        Test
                    </p>
                </article>
            </section>
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
    </body>
</html>