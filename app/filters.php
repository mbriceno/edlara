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
	if (Request::getMethod() != 'GET' && Session::token() != Input::get('_token'))
	{
        return View::make('account.login')->with('error','Session Refreshed. Please login again.');
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
            $usera = Sentry::getUser();
            $throttle = Sentry::findThrottlerByUserId($usera->id);
    if(!$throttle->isBanned() && !$throttle->isSuspended()){        
        return View::make('account.login',array('error'=>'Suspended or Banned'));
    }
});

//Admin Authentication Filter
Route::filter('admin',function(){
    if ( ! Sentry::check())
    {
        //User is not Logged In        
        $currentURL=URL::current();
        $currentURL = substr($currentURL, 8);
        $cutLength = strrpos($currentURL, '.');
        $cutLength = $cutLength + 4;
        $currentURL = substr($currentURL,$cutLength);
        Session::put('url.intended',$currentURL);
        return View::make('account.login',array('error'=>'OK'));

    }
    else
    {

        try
        {
            // Get the current active/logged in user
            $usera = Sentry::getUser();
            // Find the Administrator group
            $admin = Sentry::findGroupByName('admin');
            $throttle = Sentry::findThrottlerByUserId($usera->id);
            // Check if the user is in the administrator group
            if ($usera->inGroup($admin) && !$throttle->isBanned() && !$throttle->isSuspended())
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
   if ( ! Sentry::check())
    {
        //User is not Logged In        
        $currentURL=URL::current();
        $currentURL = substr($currentURL, 8);
        $cutLength = strrpos($currentURL, '.');
        $cutLength = $cutLength + 4;
        $currentURL = substr($currentURL,$cutLength);
        Session::put('url.intended',$currentURL);
        return View::make('account.login',array('error'=>'OK'));

    }
    else
    {

        try
        {
            // Get the current active/logged in user
            $usera = Sentry::getUser();
            // Find the Administrator group
            $teacher = Sentry::findGroupByName('teachers');
            // Find the Administrator group
            $admin = Sentry::findGroupByName('admin');

            // Check if the user is in the administrator group
            if ($usera->inGroup($admin) || $usera->inGroup($teacher))
            {
                // User is not in Administrator group
                
            }
            else
            {
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

//Student Authentication Filter

Route::filter('student',function(){
    if ( ! Sentry::check())
    {
        //User is not Logged In        
        $currentURL=URL::current();
        $currentURL = substr($currentURL, 8);
        $cutLength = strrpos($currentURL, '.');
        $cutLength = $cutLength + 4;
        $currentURL = substr($currentURL,$cutLength);
        Session::put('url.intended',$currentURL);
        return View::make('account.login',array('error'=>'OK'));

    }
    else
    {

        try
        {
            // Get the current active/logged in user
            $usera = Sentry::getUser();
            // Find the Administrator group
            $admin = Sentry::findGroupByName('admin');
            $students = Sentry::findGroupByName('students');
            $teachers = Sentry::findGroupByName('teachers');
            // Check if the user is in the administrator group
            if ($usera->inGroup($admin) || $usera->inGroup($students) || $usera->inGroup($teachers))
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


Route::filter('block_tutorial',function(){
    $session_tutorial = Session::get('halt_tutorial_except',0);
    $session_exam = Session::get('examid',0);
    if($session_exam && !Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){
        return "SYSTEM RESOURCES ARE INACCESSIBLE WHILE DOING A EXAM";
    }
});

Route::filter('exam_check',function(){
    if(!Session::get('examid')){
        return Redirect::to(URL::previous());
    }
});

Route::filter('cache', function( $response = null )
{   
    if(Setting::get('system.cache')!=0){
    $uri = URI::full() == '/' ? 'home' : Str::slug( URI::full() );
    $cached_filename = "response-$uri_".Sentry::getUser()->id;
    if ( is_null($response) )
    {
        return Cache::get( $cached_filename );
    }
    else if ( $response->status == 200 )
    {
        $cache_time = Setting::get('system.cache'); // 30 minutes
        if ( $cache_time > 0 ) {
            Cache::put( $cached_filename , $response , $cache_time );
        }
    }
}
});


//TODO:create a filter
// ApiCheck Filter

// Route::filter('api_check',function(){
//     if(Request::method()=='GET'{
//         Config::set('session.driver','native');
//         $toencrypt = "api_session_key";
//         $encrypted = Crypter::encrypt($toencrypt);
//         Session::put('session_api_key',$encrypted);
//     }
//     elseif(Request::method() == '')
// })