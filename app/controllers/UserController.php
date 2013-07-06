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
                                'email'=>'required|min:5|email|usercheck:password',
                                'password'=>'required|min:8|different:lname|different:fname|different:email|confirmed',
                                $captcha_field =>$captcha_validation));
        if ($validator->fails())
        {           
            return Redirect::to('register')->withErrors($validator);
        } 
        else
        {
            return 'OK';
        }

    }



    public function showReg(){
        if ( ! Sentry::check())
            {
                return View::make('account.register')->nest('header','main.header');

            }
            else
            {
                // User is logged in   
                return Redirect::to('/');
            }
    }

    public function checkUser($user){

           $user =  Input::all();
           Log::info($user);
    }

    protected function addUser($userdata){
        // $username = $userdata['username'];
        // $password = $userdata['password'];
        // $fname = $userdata['fname'];
        // $lname = $userdata['lname'];
        // $email = $userdata['email'];

    }

}
