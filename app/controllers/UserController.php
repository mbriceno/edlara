<?php

class UserController extends BaseController {

    //Login
    public function authenticate(){

            $username = Input::get('email');
            $password = Input::get('password-login');      
            if(!isset($password))
            {
              $password =   Input::get('password');
            }
            elseif($password == '')
            {                
              $password =   Input::get('password');
            }  

        try
        {
            // Set login credentials
            $credentials = array(
                'email'    => $username,
                'password' => $password,
            );

            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, false);            
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            Log::error('A User without Login tried to authenticate');   
            return View::make('account.login')->with('error',"Username is Required.");
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            Log::error('User with Login '.$username.' Tried to access without password.');
            return View::make('account.login')->with('error',"Password is Required");
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Log::error('User with Login '.$username.' Tried to access.But  Username was wrong');
            return View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            Log::error('User with Login '.$username.' Tried to access.The Entered password was Wrong.');            
            return View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            Log::error('User with Login '.$username.' Tried to access.But the Account was not activated yet.');           
            return View::make('account.login')->with('error',"Account Not Activated");
        }

        // The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            Log::error('User with Login '.$username.' Tried to access.But the Account was Suspended.');
            return View::make('account.login')->with('error',"Suspended");
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {            
            Log::error('User with Login '.$username.' Tried to access.But the Account was Banned.');
            return View::make('account.login')->with('error',"Banned");
        }
        if (Sentry::check())
            {
                // User is logged in  
                Log::info('User with Login '.$username.' Logged In Successfully.');         
                return  Redirect::intended('/')->with('error','OK');
            }
    }
    public function logout(){     
        Sentry::logout();
        return Redirect::to('/');        
    }

    public function register(){        
        $captcha_type = Config::get('app.captcha');
        if($captcha_type=="captcha"){
            $captcha_field = "captcha";
            $captcha_validation = 'required|min:5|captcha';
        } 
        elseif($captcha_type == "recaptcha"){
            $captcha_field = "recaptcha_response_field";
            $captcha_validation = 'required|min:5|recaptcha';
        }
        elseif($captcha_type == "checkbox"){
            $captcha_field = "checkbox_captcha";
            $captcha_validation = "required|checkbox_captcha";
        }
        $validator = Validator::make(Input::all(),
                            array('fname'=>'required|min:3|alpha|different:lname',
                                'lname'=>'required|min:3|alpha|different:fname',
                                'email'=>'required|min:5|email|usercheck',
                                'password'=>'required|min:8|different:lname|different:fname|different:email|confirmed',
                                $captcha_field =>$captcha_validation));
        if ($validator->fails())
        {           
            return Redirect::to('register')->withErrors($validator);
        } 
        else
        {
                $email = Input::get('email');
                $password =   Input::get('password');
                $fname    = Input::get('fname');
                $lname    = Input::get('lname');
                // Let's register a user.
                $user = Sentry::register(array(
                    'email'    => $email,
                    'password' => $password,
                    'first_name'=>$fname,
                    'last_name'=>$lname
                ));
                $useract = \Sentry::getUserProvider()->findByLogin($email);
                // Let's get the activation code
                $activationcode = $useract->getActivationCode();       
                $fname = Input::get('fname');
                $lname = Input::get('lname');


                $data = ['activation_code'=>$activationcode,
                    'fname'=> $fname,
                    'lname'=>$lname,
                    'email'=>$email,
                    'fullname'=>$fname.' '.$lname];


                Mail::queue('emails.welcome',$data,function($message) use ($user)
                {
                    $usermail = DB::table('users')->where('email', $user->getLogin())->first();
                    $fullname = $usermail->first_name . ' '. $usermail->last_name;
                    $message->to($user->getLogin(),$fullname)->subject('Welcome! to EdLara');
                });
                return Redirect::to('/');
        }
    }



    public function showReg(){
        if (!Sentry::check())
        {
            return View::make('account.register')->nest('header','main.header');
        }
        else
        {
            // User is logged in   
            return Redirect::to('/');
        }
    }
    public function activateUser(){
        try
        {
            $login = $this->app('Input')->get('login');
            $activationcode = $this->app('Input')->get('code');
            // Find the user using the user id
            $user = \Sentry::getUserProvider()->findByLogin($login);

            // Attempt to activate the user
            if ($user->attemptActivation($activationcode))
            {
                // User activation passed
                return Redirect::to('/login');
            }
            else
            {
                // User activation failed
                return \View::make('account.activationfail')->with('type','codemismatch');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            \Log::warning($login.' \'s account wasnt found in the system. Tried to activate the account.');            
            return \View::make('account.activationfail')->with('type','notfound');
        }
        catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
        {
            \Log::warning($login.' \'s account was already activated');
            return \View::make('account.activationfail')->with('type','alreadyactivated');
        }
    }
}
