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
//Authencticating User with Controller
Route::post('login',array('before' => 'csrf','uses' => 'LoginController@authenticate'));


//Accounts Subdomain
Route::group(array('domain' => 'account.laravel.dev','before'=>'auth'), function()
{
    
        //Making the Default View after authenticating
         Route::get('/',function()
        {
                return View::make('account.index');
        });
        Route::get('abort',function(){
            return "Test.OK";
        });
        //TODO: Settings controller
});

//Dashboard Subdomain
Route::group(array('as'=>'dashboard','domain' => 'dashboard.laravel.dev'), function()
{    
        Route::get('/', function()
        {
                return View::make('dashboard.index')->with('error','OK');
        });
        
})->before('auth');

Route::get('logout','LoginController@logout');

//HomePage Catcher
Route::get('/', function()
{
	return View::make('home');
});
