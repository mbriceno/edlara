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

//Outputting the Login Page
Route::get('login',function (){
    
    //Return The Account Login View.
    return View::make('account.login');
    
});

//Authencticating User with Controller
Route::post('login',array('before' => 'csrf','uses' => 'LoginController@authenticate'));

//Accounts Subdomain
Route::group(array('domain' => 'account.laravel.dev'), function()
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
})->before('auth');

//HomePage Catcher
Route::get('/', function()
{
	return View::make('home');
});
