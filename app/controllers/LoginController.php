<?php

class LoginController extends BaseController {

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
            return View::make('account.login')->with('error',"Username is Required");
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return View::make('account.login')->with('error',"Password is Required");
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return View::make('account.login')->with('error',"Account Not Activated");
        }

        // The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            return View::make('account.login')->with('error',"Suspended");
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
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
                return  Redirect::intended('/')->with('error','OK');
            }
    }
    public function logout(){        
        return Sentry::logout();        
    }

}
