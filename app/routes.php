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
require_once('viewcomposer.php');

//Authencticating User with Controller
Route::post('login',array('before' => 'csrf','uses' => 'UserController@authenticate'));

Route::group(array('domain' => 'account.laravel.dev'), function()
{
        Route::get('/',function()
        {
                return View::make('account.index');
        });
})->before('auth');

//Dashboard Subdomain
Route::group(array('domain' => 'dashboard.laravel.dev'), function()
{    
    Route::get('/', function()
    {
        return View::make('dashboard.index')->with('error','OK');
    });

    Route::get('sendmail', 'MailerController@test');
})->before('auth');


Route::group([],function(){
    Route::get('register','UserController@showReg');
    //New User Registration
    Route::post('register',array('before'=>'csrf',
        'uses' => 'UserController@register'));
    Route::get('/activateuser/{hash}/{email}',function($hash,$email){
    try
        {
        // Find the user using the user id
        $user = Sentry::getUserProvider()->findByLogin($email);

        // Attempt to activate the user
        if ($user->attemptActivation($hash))
        {
            // User activation passed
            echo "Passed";
        }
    
        else
        {
            echo "Failed";
        }
    }
    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
            echo 'User was not found.';
    }
    catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
    {
            echo 'User is already activated.';
    }
    });
});

Route::get('logout','UserController@logout');

Route::get('தமிழ்',function(){
    return "தமிழ்";
});
Route::get('phpinfo', function(){
    return phpinfo();
});
Route::post('api/searchuser', 'UserController@checkUser');
Route::get('/gohome',function(){
    return Redirect::route('home');
}); 

//HomePage Catcher
Route::get('/',array( 'as'=>'home',function()
{
    return View::make('home')->nest('header','main.header');
}));