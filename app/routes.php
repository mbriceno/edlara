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
Route::get('login',function(){
    return View::make('account.login');
});

//Dashboard Subdomain
Route::group(array('domain' => 'dashboard.edlara.gnanakeethan.info'), function()
{     
    Route::get('settings',array('before'=>'admin',function()
    {
        return View::make('dashboard.settings');
    }));

    Route::post('settings',array('before'=>'admin','uses'=>'SettingsController@update'));    

    Route::get('users',array('before'=>'admin',function()
    {
        return View::make('dashboard.users');
    }));
    
    Route::get('user/{id}/{mode}',array('before'=>'admin','uses'=>'UserController@manage'));
    Route::post('user/{id}/update',array('before'=>'admin','uses'=>'UserController@update'));

    Route::get('tutorials',array('before'=>'teacher',function()
    {
        return View::make('dashboard.tutorials');
    }));
    Route::get('students',array('before'=>'teacher',function(){
        return View::make('dashboard.students');
    }));
    Route::get('teachers',array('before'=>'admin',function(){
        return View::make('dashboard.teachers');
    }));



    Route::get('tutorial/edit/{id?}','TutorialsController@index')->where('id', '[0-9]+')->before('teacher');

    Route::post('tutorial/edit/{id}/update',array('before'=>'csrf|teacher','uses'=>'TutorialsController@update'));

    Route::get('tutorial/{mode}/{id}',array('before'=>'teacher','uses'=>'TutorialsController@modder'));

    Route::get('tutorial/update/{id}/{attachmentname}/{mode}',array('before'=>'teacher','uses'=>'TutorialsController@attachmentHandler'));




    Route::get('assessments',array('before'=>'teacher',function()
    {
        return View::make('dashboard.assessments');
    }));
    Route::get('assessment/{id}',array('before'=>'teacher',function($id){
        $assessment = Assessments::find($id);
        $user = User::find($assessment->teacherid);
        if(Sentry::getUser()->id == $user->id){
            return View::make('dashboard.assessments.update')->with('id',$id);
        }
        else
        {
            return "UPDATE NOT AUTHORISED";
        }
    }));
    Route::post('assessment/{id}',array('before'=>'teacher','uses'=>'AssessmentController@teacherUpdate'));






    Route::get('subjects',array('before'=>'admin',function(){
        return View::make('dashboard.subjects');
    }));
    
    Route::any('subject/edit/{id}/{mode}',array('before'=>'admin','uses'=>'SubjectController@modder'));



    //Exams
    Route::get('/exams',array('before'=>'teacher',function()
    {
        return View::make('dashboard.exams');
    }));



    Route::get('/exam/edit/{id}',array('before'=>'teacher',function ($id){
        if(Exams::find($id)){
            return View::make('dashboard.exams.edit')->with('id',$id);
        }
        return View::make('dashboard.exams.create')->with('id',0);
    }));
    Route::post('/exam/edit/0',array('before'=>'csrf|teacher','uses'=>'ExamController@createExam'));
    
    Route::post('/exam/edit/{id}',array('before'=>'csrf|teacher','uses'=>'ExamController@updateExam'));


//Test
    Route::get('/up',function(){
        return serialize([1,2,3,4]);
    });

    Route::get('/',array('before'=>'teacher','as'=>'dashboard',function()
    {
        return View::make('dashboard.index');
    }));    
    

})->before('auth');





Route::group([],function(){

    //Show New User registration
    Route::get('register','UserController@showReg');


    //New User Registration - POST
    Route::post('register',array('before'=>'csrf',
        'uses' => 'UserController@register'));


    Route::get('/activateuser/{hash}/{email}',function($hash,$email){
        
        $login =$email;
        try
        {
        // Find the user using the user id
        $user = Sentry::getUserProvider()->findByLogin($email);

            // Attempt to activate the user
            if ($user->attemptActivation($hash))
            {
                // User activation passed
                return View::make('account.login')->with('loginpass',1);
            }
            else
            {
                // User activation failed
                return View::make('account.activation')->with('error','codemismatch');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            \Log::warning($login.' \'s account wasnt found in the system. Tried to activate the account.');            
            return View::make('account.activation')->with('error','notfound');
        }
        catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
        {
            \Log::warning($login.' \'s account was already activated');
            return View::make('account.login')->with('error','Account Already Activated. Please login below with your credentials');
        }

         return View::make('account.login');
    });
    Route::get('forgotpass',function(){
        return View::make('account.forgottenpass');
    });
    Route::post('acceptreset',['before'=>'csrf','uses'=>'UserController@acceptReset']);
    Route::get('acceptreset',function(){
        return View::make('account.acceptreset');
    });
    Route::get('forgottenpass/{key}/{username}',function($key,$username){
         $user = Sentry::getUserProvider()->findByResetPasswordCode($key);
         if($user->getLogin() == $username){
            Session::flash('key',$key);
            Session::flash('username',$username);
            return View::make('account.passwordreset');
         }
         return View::make('account.login');
    });
    Route::post('resetpass',['before'=>'csrf','uses'=>'UserController@resetPass']);


});




Route::group([],function(){
    Route::get('profiles',function(){
        return;
    });
    Route::get('profile/{id?}','UserController@showProfile')->where('id', '[0-9]+');

    Route::get('profile/{id?}?edit=true',array('uses'=>'UserController@editProfile','before'=>'auth'));

});



Route::get('logout','UserController@logout');




Route::get('phpinfo', function(){
    return phpinfo();
});



Route::post('api/searchuser', 'UserController@checkUser');




Route::get('gohome',function(){
    return Redirect::route('home');
}); 

Route::get('dash',function(){
    return Redirect::route('dashboard');
});


//Tutorials
Route::get('/tutorial/{id}',array('uses'=>'TutorialsController@siteitemview'));
Route::get('/tutorials',array('uses'=>'TutorialsController@sitelistview'));
Route::get('/attachments/tutorial-{id}/{attachmentname}/download',array('before'=>'student','uses'=>'TutorialsController@siteAttachmentHandler'));
Route::get('/attachments/tutorial-{id}/{attachmentname}/view',array('before'=>'student','uses'=>'TutorialsController@siteAttachmentView'));


//Assessments
Route::get('assessment/submit/{id}/{hash}',array('before'=>'student',function($id,$hash){
                        $tutorial =  Tutorials::findOrFail($id);
                        $sessionvar = "tutorial-".$tutorial->id;
                        $senc = Session::get($sessionvar);
                        try
                        {
                        $decrypted = Crypt::decrypt($hash);
                        }
                        catch(Exception $e){
                            //Catch Exception
                        }

                        if($senc == $hash && $decrypted == $sessionvar){
                            Session::put('tutorialid',$id);
                            return Redirect::to('assessment/submit');
                        }
                        else
                        {
                            return "Unauthorised Access";
                        }
}));
Route::get('assessment/submit',array( 'before'=>'student','uses'=>'AssessmentController@submitview'));
Route::post('assessment/submit',array( 'before'=>'student','uses'=>'AssessmentController@submit'));
Route::get('assessment/update',array( 'before'=>'student','uses'=>'AssessmentController@updateList'));
Route::get('assessment/update/{id}',array( 'before'=>'student','uses'=>'AssessmentController@updateView'));
Route::post('assessment/update/{id}',array( 'before'=>'student','uses'=>'AssessmentController@update'));

Route::get('/attachments/assessment-{id}/{filename}/download',array('before'=>'student','uses'=>'AssessmentController@download'));
Route::get('/attachments/assessment-{id}/{filename}/delete',array('before'=>'student','uses'=>'AssessmentController@attachmentDelete'));
Route::get('/attachments/assessment-{id}/{filename}/view',array('before'=>'student','uses'=>'AssessmentController@attachmentView'));


Route::get('/tutorial-{id}/exam-{eid}/{hash}',array('before'=>'student','uses'=>'ExamController@validateStudent'));
Route::get('/tutorial-{id}/exam-{eid}',array('before'=>'student','uses'=>'ExamController@viewExam'));
Route::post('/tutorial-{id}/exam-{eid}/{hash}',array('before'=>'student','uses'=>'ExamController@doExam'));
Route::get('/tutorial-{id}/exam-{eid}/view/{hash}',array('before'=>'student','uses'=>'ExamController@doneExam'));

//HomePage Catcher
Route::get('/',array('as'=>'home',function()
{
    return View::make('home')->nest('header','main.header');
}));
