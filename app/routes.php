<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
        
Route::get('login/{returnTo?}',function ($returnTo='/'){
    
    //Return The Account Login View.
    return View::make('account.login')->with('returnTo',$returnTo);
});

//Accounts Subdomain
Route::group(array('domain' => 'account.laravel.dev','before'=>'auth'), function()
{
         Route::get('/', function()
        {
                return View::make('account.index');
        });
});


//Dashboard Subdomain
Route::group(array('domain' => 'dashboard.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('dashboard.index');
        });
})->before('auth');



//
Route::group(array('domain' => 'statistics.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('statistics.index');
        });
})->before('auth');

Route::get('/', function()
{
	return View::make('home');
});


Route::filter('auth',function(){
    if (!Sentry::check()){ 
        Redirect::to('/login/');
    }    
    else {        
        //User is Logged In
        //Redirect::to('/');
    }
});
