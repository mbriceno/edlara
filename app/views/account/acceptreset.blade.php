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
                   password reset link has been send to the email address provided with your account. please check your email box for reset password link.
                    <a class="btn btn-large btn-success" href="/gohome">Return to HomePage</a>
                </div>
            </div>
        </div>
        
        {{-- Bootstrap JS Compiled --}}
        
         @javascripts('bootstrap')
         @javascripts('grans') 
        
    </body>

</html>