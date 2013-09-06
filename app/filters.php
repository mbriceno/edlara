<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


//Main Authentication Filter

Route::filter('auth',function(){
    if (!Sentry::check()){
        //User is not Logged In        
        $currentURL=URL::current();
        $currentURL = substr($currentURL, 8);
        $cutLength = strrpos($currentURL, '.');
        $cutLength = $cutLength + 4;
        $currentURL = substr($currentURL,$cutLength);
        Session::put('url.intended',$currentURL);
        return View::make('account.login',array('error'=>'OK'));
    }
});

//Admin Authentication Filter
//TODO: create a filter to allow only admins to access sensitive parts of dashboard.
Route::filter('admin',function(){
      if ( ! Sentry::check())
    {
    // User is not logged in, or is not activated
    }
    else
    {

        try
        {
            // Get the current active/logged in user
            $usera = Sentry::getUser();
            // Find the Administrator group
            $admin = Sentry::findGroupByName('admin');

            // Check if the user is in the administrator group
            if ($usera->inGroup($admin))
            {
                // User is in Administrator group
            }
            else
            {
                // User is not in Administrator group
                return View::make('access.notauthorised');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // User wasn't found, should only happen if the user was deleted
            // when they were already logged in or had a "remember me" cookie set
            // and they were deleted.
        }
    }  
        
});
//Teacher Authentication Filter

//TODO: create a filter
Route::filter('teacher',function(){
    //Complete this
});

//Student Authentication Filter

//TODO:create a filter