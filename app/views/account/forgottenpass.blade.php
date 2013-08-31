<!DOCTYPE html>
<html>
    <head>
        <title>Edlara - ResetPassword</title>
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
                    if($errors->first('email')){

                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('email');                            
                            echo "</div>";
                    }
                    echo Form::open(array('url' => 'acceptreset',
                        'method' => 'post'));
                    
                    //Echo FORM Label for Password address
                    echo Form::label('email', 'Email', array(
                        'class' => 'lbl-email-reset'));
                    
                    //Echo FORM Element for Password
                    echo Form::email('email',"",array(
                        'class' => 'email-reset',
                        'placeholder' => 'jonh.doe@gmail.com',
                        'autocomplete' => 'off'));
                        

                    echo "<br>";

                    //Echo FORM Element for Submit
                    echo Form::submit('Send Link',
                            array('class'=>'btn  btn-info'));

                    echo Form::token();
                    echo Form::close();
                    ?>
                    <a class="btn btn-danger" href="/gohome">Return to HomePage</a>
                </div>
            </div>
        </div>
        
        {{-- Bootstrap JS Compiled --}}
        
         @javascripts('bootstrap')
         @javascripts('grans') 
        
    </body>

</html>