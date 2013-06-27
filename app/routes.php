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
$baseurl = Config::get('app.baseurl', 'laravel.dev');
//Authencticating User with Controller
Route::post('login',array('before' => 'csrf',
    'uses' => 'UserController@authenticate'));
//New User Registration
Route::post('register',array('before'=>'csrf',
    'uses' => 'UserController@register'));

//Accounts Subdomain
Route::group(array('domain' => 'account.laravel.dev',
    'before'=>'auth'), function()
{
    //Making the Default View after authenticating
    Route::get('/',function()
    {
        return View::make('account.index');
    });
    //TODO: Settings controller
});

//Dashboard Subdomain
Route::group(array('as'=>'dashboard',
    'domain' => 'dashboard.laravel.dev','before'=>'auth'), function()
{    
    Route::get('/', function()
    {
        return View::make('dashboard.index')->with('error','OK');
    });
});

Route::get('register','UserController@showReg');

Route::get('logout','UserController@logout');

Route::get('தமிழ்',function(){
    return "தமிழ்";
});

//HomePage Catcher
Route::get('/', function()
{
	return View::make('home');
});

