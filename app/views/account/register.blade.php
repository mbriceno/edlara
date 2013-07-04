<!DOCTYPE html>
<html>
    <head>
        <title>EdLara - SignUp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans') 
        

    </head>
    <body>
        {{ $header }}
        <div class='container-fluid' >
            <div class='row-fluid' id="main-container">

                    <div class="registration-box offset1 span6" id="registration-box">
                        <div class="container-fluid">        
                    <?php
                    if($errors->first('email')){

                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('email');                            
                            echo "</div>";
                    }
                    if($errors->first('password')){

                            echo "<div class='alert  alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('password');                            
                            echo "</div>";
                    }
                    if($errors->first('password-chk')){

                            echo "<div class='alert  alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('password-chk');                            
                            echo "</div>";
                    }
                    if($errors->first('lname')){

                            echo "<div class='alert  alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('lname');                            
                            echo "</div>";
                    }
                    if($errors->first('fname')){

                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo $errors->first('fname');                            
                            echo "</div>";
                    }
                    if($errors->first('captcha')){

                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo "Please Re-Enter Captcha. and Also the Form";                            
                            echo "</div>";
                    }
                    if($errors->first('checkbox_captcha')){

                            echo "<div class='alert alert-error alert-block fade in'>";
                            echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                            echo "Please Re-Enter Captcha. and Also the Form";                            
                            echo "</div>";
                    }
                        echo Form::open(['url'=> 'register','method'=>'post','id'=>'registration-form']);
                        
                        
                        
                        // First Name and Last Name
                        echo "<div class=\"row-fluid\"><div class='span6'>";
                        echo Form::label('fname',"First Name *",array('class'=>'fname-reg-box-label'));
                        echo Form::text('fname',"",array('class'=>'fname-reg-box','placeholder'=>'John'));
                        echo "</div>";
                        
                        echo "<div class='span6 pull-right'>";
                        echo Form::label('lname',"Last Name *",array('class'=>'lname-reg-box-label'));
                        echo Form::text('lname',"",array('class'=>'lname-reg-box','placeholder'=>'Doe'));
                        echo "</div></div>";


                        // Email Address
                        echo "<div class='row-fluid'><div class='span6'>";
                        echo Form::label('email',"Email Address *",array('class'=>'email-reg-box-label'));
                        echo Form::email('email',"",array('class'=>'email-reg-box','placeholder'=>'johndoe@example.com','required'));


                        echo "</div><div id=\"usercheck\"></div>";
                        echo "<div class='span6 pull-right'>";
                        echo Form::label('password',"Password *",array('class'=>'pwd-reg-box-label'));
                        echo Form::password('password',array('class'=>'password-reg-box'));
                        echo '</div></div>';



                        echo "<div class='span6 pull-right'>";
                        echo Form::label('password_confirmation',"Re-Enter Password",array('class'=>'pwd-chk-reg-box-label'));
                        echo Form::password('password_confirmation',array('class'=>'password-chk-reg-box'));
                        echo '</div>';


                        
                        echo "<br><br>";

                        // Account Type.
                        echo "<div class=\"row-fluid\"><div class='offset1 span6'>";
                        echo Form::label('actype',"Acccount Type",array('class'=>'actype-reg-box-label pull-left','required'));
                        echo "</div>";


                        echo "<div class='span4'>";
                        echo Form::select('actype', array('S' => 'Student', 'T' => 'Teacher'), 'S',array('class'=>'actype-reg-box','name'=>'actype'));
                        echo "</div></div><br>* Required<br><br>";


                        $captcha_type = Config::get('app.captcha');
                        if($captcha_type == "captcha"){
                            echo Form::captcha();
                        } 
                        elseif($captcha_type == "recaptcha"){
                            echo Form::recaptcha();
                        }
                        elseif($captcha_type == "checkbox"){
                            echo Form::checkbox_captcha();      
                        }

                        echo "<div id='policy'>By Clicking Register . You Agree to our <a href=\"about/tos\"> Terms of Service </a> and <a href=\"about/privacy-policy\">Privacy Policy.</a></div>";

                        echo Form::submit('Register', array('value'=>'Register','class' => 'btn btn-info btn-register pull-right'));

                        
                        // Token
                        echo Form::token();   

                        // Close Form
                        echo Form::close();
                    ?>
                    </div>
                    </div>
                </div>            
            </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
           $(document).ready(function(){
            var validator =  $("#registration-form").validate({
                rules: {
                    fname: {
                        required: true,
                        minlength:3
                    },
                    lname: {
                        required: true,
                        minlength:3
                    },
                    username: {
                        required: true,
                        minlength:4
                    },
                    email: {
                        required: true,
                        minlength: 5
                    },
                    password:{
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation:{
                        required:true,
                        equalTo: "#password",
                        minlength:8,
                    }
                    ,
                    captcha:{
                        required: true,
                        minlength:5,
                        maxlength:5
                    }

                },
                messages: {
                    fname: {
                        required: "Enter your firstname",
                        minlength: "Should be 3 or more letters."
                    },
                    lname: {
                        required: "Enter your lastname",
                        minlength: "Should be 3 or more letters."                        
                    },
                    email: {
                        required: "We Need email to send You Regular Updates.",
                        minlength: "Your Email should not be less than 7 letters."
                    },
                    password: {
                        required: "Provide a password",
                        rangelength: jQuery.format("Enter at least {0} characters")
                    },
                    password_confirmation: {
                        required: "Repeat your password",
                        minlength: jQuery.format("Enter at least {0} characters"),
                        equalTo: "Enter the same password as above"
                    }
                }           
            });             

           });
      
        </script>     
    </body>
</html>                