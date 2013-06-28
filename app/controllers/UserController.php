<?php

class UserController extends BaseController {

    //Login
    public function authenticate(){
        $username= Input::get('email');
        $password= Input::get('password');
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
        if ( ! Sentry::check())
            {
                //User is not Logged In
            //    return Redirect::to('');            
            }
            else
            {
                // User is logged in   
                
            Log::info('User with Login '.$username.' Logged In Successfully.');         
                return  Redirect::intended('/')->with('error','OK');
            }
    }
    public function logout(){     
    Sentry::logout()   ;
        return Redirect::to('/');        
    }

    public function register(){
        //TODO: Code to Add
        return 'test';
    }



    public function showReg(){
        if ( ! Sentry::check())
            {
                // User is not Logged in. So Lets Show the registration form.
                return View::make('account.register');     
            }
            else
            {
                // User is logged in   
                return Redirect::to('/');
            }
    }

}
