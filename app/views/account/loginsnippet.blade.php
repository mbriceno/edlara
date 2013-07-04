<?php
                    //Error message will be shown if user has a failed attempt.
                    if(isset($error)){
                        if ($error !== 'OK'){
                            echo "<div class='alert alert-error error-loginpage-alert'>$error</div>";
                        }
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
                    echo Form::label('password-login', 'Password', array(
                        'class' => 'lbl-pwd-login'));
                    
                    //Echo FORM Element for Password
                    echo Form::password('password-login',"",array(
                        'class' => 'pwd-login',
                        'placeholder' => 'Password',
                        'autocomplete' => 'off'));

                    echo "<br>";

                    //Echo FORM Element for Submit
                    echo Form::submit('Login',
                            array('class'=>'btn btn-large btn-info'));

                    echo Form::token();
                    echo Form::close();
                    echo "</li> <li><a href=\"/register\">Don't Have a Account!!!</a></li>";