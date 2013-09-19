<!doctype html>
<html>
    <head>
        <title>User - {{User::find($id)->first_name.' '.User::find($id)->last_name }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>
                <div class="span3 offset2">
                <?php
                $user = User::find($id);
                $userdata = Student::find($id);
                $userstram = 'student';
                if($userdata == NULL){
                    $userdata = Teacher::find($id);
                    $userstream = 'teacher';
                }
                else{
                    $userdata;
                }
                ?>
                    <div class="pull-left">
                        First Name -
                    </div>
                    <div class="pull-right">
                        {{$user->first_name}}
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Last Name -
                    </div>
                    <div class="pull-right">
                        {{$user->last_name}}
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Email -
                    </div>
                    <div class="pull-right">
                        <?php
                        if(Sentry::getUser()->id == $id || Sentry::getUser()->inGroup(Sentry::findGroupByName('admin')))
                        {
                            echo $user->email;
                        }
                        else 
                        {
                            echo "Email is only visible to Admin and User whom it belongs to.";
                        }
                        ?>
                    </div><br>&nbsp;<br>
                    <div class="pull-left">
                        Date Of Birth
                    </div>
                    <div class="pull-right">
                        <?php
                        if($userdata !== NULL){
                            echo $userdata->dob;
                        }
                        ?>
                    </div><br>

                </div>
                <div class="span3">
                    <?php
                    // user email
    $email = $user->email;

    // create some gravatarer object 
    $gravatar = Gravatarer::user( $email )->size('120');

     // get gravatar <img> html code
    $html = $gravatar->html();
                   var_dump($html)
?>

                </div>
            </div>
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
            $('#navbar').scrollspy();
        </script>
    </body>
</html>