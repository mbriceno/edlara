<!DOCTYPE html>
<html>
    <head>
        <title>{{ Setting::get('system.schoolname') }}- ResetPassword</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')      
    </head>
    <body>         
        <div class='container-fluid'>
            <div class='row-fluid'>                
                <div id="pwd-reset-form" class="span-4 offset4">                    
                    <?php
                    //Error message will be shown if user has a failed attempt.
                    
                    echo Form::open(array('url' => 'resetpass',
                        'method' => 'post'));
                    
                    //Echo FORM Label for Password address
                    echo Form::label('password', 'Password', array(
                        'class' => 'lbl-pwd-rest'));
                    
                    //Echo FORM Element for Password
                    echo Form::password('password',"",array(
                        'class' => 'pwd-reset',
                        'placeholder' => 'Password',
                        'autocomplete' => 'off'));

                        
                    //Echo FORM Label for Password address
                    echo Form::label('password_confirmation', 'Confirm Password', array(
                        'class' => 'lbl-pwd-rest'));
                    
                    //Echo FORM Element for Password
                    echo Form::password('password_confirmation',"",array(
                        'class' => 'pwd-reset',
                        'placeholder' => 'Confirm Password',
                        'autocomplete' => 'off'));

                    echo "<br>";

                    //Echo FORM Element for Submit
                    echo Form::submit('reset',
                            array('class'=>'btn btn-large btn-info'));

                    echo Form::token();
                    echo Form::close();
                    ?>
                    <a class="btn btn-large btn-danger" href="/gohome">Return to HomePage</a>
                </div>
            </div>
        </div>
        
        {{-- Bootstrap JS Compiled --}}
        
         @javascripts('bootstrap')
         @javascripts('grans') 
        
    </body>

</html>