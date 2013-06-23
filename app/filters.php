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
        //return Redirect::to('/login/')->with('error','OK');
    }
});
