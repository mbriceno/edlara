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
require_once('staticfunctions.php');

define('ROOT', 1);

//Authencticating User with Controller
Route::post('login', array('before' => 'csrf','uses' => 'UserController@authenticate'));
Route::get('login', function () {
    return View::make('account.login');
});

Route::get('logout','UserController@logout');


//API Subdomain
Route::group(array('domain' => 'api.'.Setting::get('system.siteurlshort')),function(){
    header('Access-Control-Allow-Origin: *');  
    Route::get('/',array('before'=>'api_check','uses'=>'ApiController@index'));
    Route::get('/tutorials.json',array('before'=>'api_check','uses'=>'ApiController@tutorials'));
    Route::get('/tutorial/{id}.json',array('before'=>'api_check','uses'=>'ApiController@tutorial'));
    Route::get('/exams.json',array('before'=>'api_check','uses'=>'ApiController@exams'));
    Route::get('/exam/{id}',array('before'=>'api_check','uses'=>'ApiController@exam'));
});




//Dashboard Subdomain
Route::group(array('domain' => '{dashboard}.laravel.dev'), function () {

    Route::get('settings', array('before'=>'admin','uses'=>'DashboardController@settings'));
    Route::get('users', array('before'=>'admin','uses'=>'DashboardController@users'));
    Route::get('teachers', array('before'=>'admin','uses'=>'DashboardController@teachers'));
    Route::get('students', array('before'=>'admin','uses'=>'DashboardController@students'));
    Route::get('exams',array('before'=>'teacher','uses'=>'DashboardController@exams'));
    Route::get('subjects',array('before'=>'admin','uses'=>'DashboardController@subjects'));
    Route::get('tutorials', array('before'=>'teacher','uses'=>'DashboardController@tutorials'));
    Route::get('assessments',array('before'=>'teacher','uses'=>'DashboardController@assessments'));
    Route::get('/',array('as'=>'dashboard','before'=>'teacher','uses'=>'DashboardController@dash'));



    Route::get('tutorial/edit/{id?}','TutorialsController@index')->where('id', '[0-9]+')->before('teacher');
    Route::get('tutorial/{mode}/{id}',array('before'=>'teacher','uses'=>'TutorialsController@modder'));
    Route::get('tutorial/update/{id}/{attachmentname}/{mode}',array('before'=>'teacher','uses'=>'TutorialsController@attachmentHandler'));
    Route::get('assessment/{id}',array('before'=>'teacher','uses'=>'HttpController@assessmentupdateget'));
    Route::get('/assessment-{aid}/exam-{eid}/markup',array('before'=>'teacher','uses'=>'ExamController@markExam'));
    

    Route::get('/exam/edit/{id}',array('before'=>'teacher','uses'=>'HttpController@examupdateget'));
    Route::get('/exam/view/{id}',array('before'=>'teacher',function($dash,$id){
        if(Exams::find($id)){
            return View::make('dashboard.exams.view')->with('id',$id);
        }
        return View::make('dashboard.exams.create')->with('id',0);
    }));
    Route::get('/exam/delete/{id}',array('before'=>'admin',function($dash,$id){
        $exam = Exams::findOrFail($id);
        $examdata = DB::select(DB::raw('SELECT exams FROM tutorials'));
        $examdata = objectToArray($examdata);
        $pass=[];
        foreach($examdata as $exam){
            if($exam["exams"]!= NULL){
                $exam = unserialize($exam["exams"]);
                if((int)$exam["id"] !== (int)$id){
                    $pass[]=true;
                }
                elseif((int)$exam["id"] == (int)$id) {
                    $pass[]=false;
                }
            }
        }
        if (in_array(false, $pass, true)) {
        }
        else {
            $exam->delete();
        }
        return Redirect::to("/exams");
    }));
    Route::get('/tutorial/edit/{id}/presentation',array('before'=>'teacher','uses'=>'PresentationController@view'))->where('id', '[0-9]+');
    Route::get('user/{id}/{mode}', array('before'=>'teacher','uses'=>'UserController@manage'))->where('id', '[0-9]+');


    Route::post('tutorial/edit/{id}/update',array('before'=>'csrf|teacher','uses'=>'TutorialsController@update'))->where('id', '[0-9]+');
    Route::post('tutorial/edit/{id}/create-presentation',array('before'=>'csrf|teacher','uses'=>'PresentationController@create'))->where('id', '[0-9]+');

    Route::post('assessment/{id}',array('before'=>'csrf|teacher','uses'=>'AssessmentController@teacherUpdate'));

    Route::post('user/{id}/update', array('before'=>'csrf|admin','uses'=>'UserController@update'));

    Route::post('/exam/edit/0',array('before'=>'csrf|teacher','uses'=>'ExamController@createExam'));
    Route::post('/exam/edit/{id}',array('before'=>'csrf|teacher','uses'=>'ExamController@updateExam'));
    
    Route::post('settings', array('before'=>'csrf|admin', 'uses'=>'SettingsController@update'));
    Route::get('clearcache',array('before'=>'admin',function(){
        Artisan::call('cache:clear');
        Cache::flush();
        return Redirect::to(URL::previous());
    }));
    Route::any('subject/edit/{id}/{mode}',array('before'=>'csrf|admin','uses'=>'SubjectController@modder'));
})->before('auth|cache')->where('dashboard',Setting::get('system.dashurlshort'));





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

    // Forgotten Password Get Link Page.
    Route::get('forgotpass',function(){
        return View::make('account.forgottenpass');
    });

    // Accept Reset POST
    Route::post('acceptreset',['before'=>'csrf','uses'=>'UserController@acceptReset']);
    
    // Accept Reset GET
    Route::get('acceptreset',function(){
        return View::make('account.acceptreset');
    });

    // Accept Forgotten Password Reset Request. and Allow reset Password.
    Route::get('forgottenpass/{key}/{username}',function($key,$username){
         $user = Sentry::getUserProvider()->findByResetPasswordCode($key);
         if($user->getLogin() == $username){
            Session::flash('key',$key);
            Session::flash('username',$username);
            return View::make('account.passwordreset');
         }
         return View::make('account.login');
    });

    // Reset Password Accept
    Route::post('resetpass',['before'=>'csrf','uses'=>'UserController@resetPass']);
});




Route::group([],function(){
    Route::get('profiles',function(){
        return;
    });
    
    // User Show Profile
    Route::get('profile/{id?}','UserController@showProfile')->where('id', '[0-9]+');
    
    // User Profile Edit
    Route::get('profile/{id?}?edit=true',array('uses'=>'UserController@editProfile','before'=>'auth'));

});


//Tutorials

// Tutorial Item View
Route::get('/tutorial/{id}',array('before'=>'block_tutorial','uses'=>'TutorialsController@siteitemview'));

// Tutorials List View
Route::get('/tutorials',array('before'=>'block_tutorial','uses'=>'TutorialsController@sitelistview'));

// Tutorial Attachment Download
Route::get('/attachments/tutorial-{id}/{attachmentname}/download',array('before'=>'student|block_tutorial','uses'=>'TutorialsController@siteAttachmentHandler'));

// Tutorial Attachment View
Route::get('/attachments/tutorial-{id}/{attachmentname}/view',array('before'=>'student|block_tutorial','uses'=>'TutorialsController@siteAttachmentView'));


//Assessments

// Providing Assessment Submit Securely hashed page.
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

// Submit Assessment POST
Route::post('assessment/submit',array( 'before'=>'student','uses'=>'AssessmentController@submit'));

// Update Assessment- Student Only.
Route::post('assessment/update/{id}',array( 'before'=>'student','uses'=>'AssessmentController@update'));

//Validating Exam Work
Route::post('/tutorial-{tid}/exam-{eid}/{hash}',array('before'=>'student','uses'=>'ExamController@doExam'));

// Submit Assessment GET
Route::get('assessment/submit',array( 'before'=>'student','uses'=>'AssessmentController@submitview'));

// Download Assessment Attachment
Route::get('/attachments/assessment-{id}/{filename}/download',array('before'=>'student','uses'=>'AssessmentController@download'));

// Delete Assessment Attachment
Route::get('/attachments/assessment-{id}/{filename}/delete',array('before'=>'student','uses'=>'AssessmentController@attachmentDelete'));

// View Assessment Attachment
Route::get('/attachments/assessment-{id}/{filename}/view',array('before'=>'student','uses'=>'AssessmentController@attachmentView'));

// Validate the Exam
Route::get('/tutorial-{id}/exam-{eid}/{hash}',array('before'=>'student','uses'=>'ExamController@validateStudent'));

//Exam View
Route::get('/tutorial-{id}/exam',array('before'=>'student|exam_check','uses'=>'ExamController@viewExam'));

// Updatable Assessment List
Route::get('assessment/update',array( 'before'=>'student','uses'=>'AssessmentController@updateList'));

// Update Assessment View - Student Only.
Route::get('assessment/update/{id}',array( 'before'=>'student','uses'=>'AssessmentController@updateView'));

// Get About Us page
Route::get('/aboutus',function(){   
    $theme = Theme::uses('site')->layout('default');
    $theme->appendTitle('- About Us');
    return $theme->scope('about.about')->render();
});

// Get About TOS page.
Route::get('/about/tos',function(){
    $theme = Theme::uses('site')->layout('default');
    $theme->appendTitle('- Terms of Service');
    return $theme->scope('about.terms')->render();
});

//Get Contact Us Page.
Route::get('contactus',function(){
    $theme = Theme::uses('site')->layout('default');
    $theme->appendTitle('- Contact Us');
    return $theme->scope('about.contact')->render();
});

// Go Home Redirect
Route::get('gohome',function(){
    return Redirect::route('home');
}); 
// Go Dashboard Redirect
Route::get('dash',function(){
    return Redirect::to('http://'.Setting::get('system.dashurlshort','dashboard').'.'.Setting::get('system.siteurlshort'));
});

//HomePage Catcher
Route::get('/',array('as'=>'home','uses'=>'HomeController@index'));


// App::missing(function($exception)
// {
//     return Response::view('site.error.404', array(), 404);
// });
// App::error(function(Exception $exception)
// {
//     Log::error($exception);
//     return Response::view('site.error.system',array(),500);
// });
// App::error(function(Illuminate \ Database \ Eloquent \ ModelNotFoundException $exception)
// {
//     Log::error($exception);
//     return Response::view('site.error.system',array(),500);
// });