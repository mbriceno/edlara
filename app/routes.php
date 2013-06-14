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

Route::group(array('domain' => 'account.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('account.index');
        });
});
Route::group(array('domain' => 'dashboard.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('dashboard.index');
        });
});
Route::group(array('domain' => 'statistics.laravel.dev'), function()
{
    
        Route::get('/', function()
        {
                return View::make('statistics.index');
        });
});
Route::get('/', function()
{
	return View::make('home');
});