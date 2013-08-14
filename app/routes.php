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
Route::group(array('as'=>'dash','domain' => 'dashboard.laravel.dev'), function()
{    
    Route::get('/', function()
    {
        return View::make('dashboard.index')->with('error','OK');
    });

})->before('auth');





Route::group([],function(){

    //Show New User registration
    Route::get('register','UserController@showReg');


    //New User Registration - POST
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
                return \View::make('account.login')->with('loginpass',1);
            }
            else
            {
                // User activation failed
                return \View::make('account.activation')->with('error','codemismatch');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            \Log::warning($login.' \'s account wasnt found in the system. Tried to activate the account.');            
            return \View::make('account.activationfail')->with('type','notfound');
        }
        catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
        {
            \Log::warning($login.' \'s account was already activated');
            return \View::make('account.activationfail')->with('type','alreadyactivated');
        }
    });

});




Route::group([],function(){
    Route::get('u/{username}.html','UserController@showProfile');

    Route::get('u/{username}.html?edit=true',array('uses'=>'UserController@editProfile','before'=>'auth'));

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

Route::get('/dash',function(){
    return Redirect::route('dash');
});


//HomePage Catcher
Route::get('/',array( 'as'=>'home',function()
{
    return View::make('home')->nest('header','main.header');
}));