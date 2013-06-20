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
        
Route::get('login/urlto/{urlTo?}',function ($urlTo=NULL){
    
    //Return The Account Login View.
    return View::make('account.login')->with('urlTo',$urlTo);
    
});

//Accounts Subdomain
Route::group(array('domain' => 'account.laravel.dev','before'=>'auth'), function()
{
         Route::get('/',array('before'=>'auth' ,function()
        {
                return View::make('account.index');
        }));
})->before('auth');

//Dashboard Subdomain
Route::group(array('domain' => 'dashboard.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('dashboard.index');
        });
});

//Statistics Subdomain
Route::group(array('domain' => 'statistics.laravel.dev','before'=>'auth'), function()
{
    
        Route::get('/',function()
        {
                return View::make('statistics.index');
        });
});

Route::get('/',array('before'=>'auth',  function()
{
	return View::make('home');
}));

Route::filter('auth',function(){
    if (!Sentry::check()){
        //User is not Logged In        
        $currentURL = URL::current();
        $currentURL = substr($currentURL, 8);
        return Redirect::to('/login/urlto/'.$currentURL);
    }    
    else {        
        //User is Logged In
        return Redirect::to('/');
    }
});
