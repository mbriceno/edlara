<!DOCTYPE html>
<html>
    <head>
        <title>Edlara -Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')      
    </head>
    <body>         
        <div class='container-fluid'>
            <div class='row-fluid'>                
                <div id="login-form" class="span-4 offset4">                    
                    <?php
                    //Error message will be shown if user has a failed attempt.
                    if ($error !== 'OK'){
                       echo "<div class='alert alert-error error-loginpage-alert'>$error</div>";
                    }
                    if (isset($loginpass)){
                        echo "<div class='alert alert-success success-loginpage-alert'>You have successfully activated Your account</div>";
                    }
                    echo Form::open(array('url' => 'login',
                        'method' => 'post'));
                    
                    //Echo FORM Label for Email address
                    echo Form::label('email', 'E-Mail Address', array(
                        'class' => 'lbl-email-addr-login'));

                    //Echo FORM Element for Email address
                    echo Form::text('email', "",array(
                        'class' => 'email-addr-login',
                        'placeholder' => 'johndoe@example.com',
                        'autocomplete' => 'off'));
                        
                    //Echo FORM Label for Password address
                    echo Form::label('password', 'Password', array(
                        'class' => 'lbl-pwd-login'));
                    
                    //Echo FORM Element for Password
                    echo Form::password('password',"",array(
                        'class' => 'pwd-login',
                        'placeholder' => 'Password',
                        'autocomplete' => 'off'));

                    echo "<br>";

                    //Echo FORM Element for Submit
                    echo Form::submit('Login',
                            array('class'=>'btn btn-large btn-info'));

                    echo Form::token();
                    echo Form::close();
                    ?>
                    <a class="btn btn-large btn-danger" href="<?php echo Config::get('app.url'); ?>">Return to HomePage</a>
                </div>
            </div>
        </div>
        
        {{-- Bootstrap JS Compiled --}}
        
         @javascripts('bootstrap')
         @javascripts('grans') 
        
    </body>

</html>