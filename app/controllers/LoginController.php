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
            View::make('account.login')->with('error',"Username is Required");
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            View::make('account.login')->with('error',"Password is Required");
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            View::make('account.login')->with('error',"Username or Password is wrong");
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            View::make('account.login')->with('error',"Account Not Activated");
        }

        // The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            echo 'User is suspended.';
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            echo 'User is banned.';
        }
        if ( ! Sentry::check())
            {
            // User is not logged in, or is not activated
            }
            else
            {
            // User is logged in
            }
    }

}
