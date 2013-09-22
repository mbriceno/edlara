<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
  app_path().'/events',
));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});
//var_dump(__DIR__);
$publicdir = __DIR__.'/../../public/';
require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

Basset::collection('bootstrap', function($collection)
{
    // Collection definition.  
    $collection->add('../public/js/jquery-1.9.0.min.js');
    // $collection->add('../public/js/jquery-migrate-1.2.0.min.js');
    $collection->add('../public/css/bootstrap.min.css');
    $collection->add('../public/css/bootstrap-responsive.min.css');
    $collection->add('../public/js/bootstrap.min.js');
    $collection->add('../public/js/jquery.validate.min.js');
    $collection->add('../public/js/additional-methods.min.js');
});

Basset::collection('grans', function($collection)
{
    // Collection definition.
    $collection->add('../public/css/system/main.css');
    $collection->add('../public/css/system/parallax.css');
    $collection->add('../public/js/jquery.fittext.js');    
    $collection->add('../public/js/system/parallax.js');
});

Basset::collection('dashboard',function($collection)
{
    $collection->add('../public/css/bootstrap-cerulean.css');
    $collection->add('../public/css/bootstrap-responsive.css');
    $collection->add('../public/css/charisma-app.css');
    $collection->add('../public/css/jquery-ui-1.8.21.custom.css');
    $collection->add('../public/css/fullcalendar.css');
    $collection->add('../public/css/fullcalendar.print.css');
    $collection->add('../public/css/chosen.css');
    $collection->add('../public/css/uniform.default.css');
    $collection->add('../public/css/colorbox.css');
    $collection->add('../public/css/jquery.cleditor.css');
    $collection->add('../public/css/jquery.noty.css');
    $collection->add('../public/css/noty_theme_default.css');
    $collection->add('../public/css/elfinder.min.css');
    $collection->add('../public/css/elfinder.theme.css');
    $collection->add('../public/css/jquery.iphone.toggle.css');
    $collection->add('../public/css/opa-icons.css');
    $collection->add('../public/css/uploadify.css');
    $collection->add('../public/js/jquery-1.7.2.min.js');
    $collection->add('../public/js/jquery-ui-1.8.21.custom.min.js');
    $collection->add('../public/js/bootstrap-transition.js');
    $collection->add('../public/js/bootstrap-alert.js');
    $collection->add('../public/js/bootstrap-modal.js');
    $collection->add('../public/js/bootstrap-dropdown.js');
    $collection->add('../public/js/bootstrap-scrollspy.js');
    $collection->add('../public/js/bootstrap-tab.js');
    $collection->add('../public/js/bootstrap-tooltip.js');
    $collection->add('../public/js/bootstrap-popover.js');
    $collection->add('../public/js/bootstrap-button.js');
    $collection->add('../public/js/bootstrap-collapse.js');
    $collection->add('../public/js/bootstrap-carousel.js');
    $collection->add('../public/js/bootstrap-typeahead.js');
    $collection->add('../public/js/bootstrap-tour.js');
    $collection->add('../public/js/jquery.cookie.js');
    $collection->add('../public/js/fullcalendar.min.js');
    $collection->add('../public/js/excanvas.js');
    $collection->add('../public/js/jquery.flot.min.js');
    $collection->add('../public/js/jquery.flot.pie.min.js');
    $collection->add('../public/js/jquery.flot.stack.min.js');
    $collection->add('../public/js/jquery.flot.resize.min.js');
    $collection->add('../public/js/jquery.chosen.min.js');
    $collection->add('../public/js/jquery.uniform.min.js');
    $collection->add('../public/js/jquery.colorbox.min.js');
    $collection->add('../public/js/jquery.cleditor.min.js');
    $collection->add('../public/js/jquery.noty.js');
    $collection->add('../public/js/jquery.elfinder.min.js');
    $collection->add('../public/js/jquery.raty.min.js');
    $collection->add('../public/js/jquery.iphone.toggle.js');
    $collection->add('../public/js/jquery.autogrow-textarea.js');
    $collection->add('../public/js/jquery.uploadify-3.1.min.js');
    $collection->add('../public/js/jquery.history.js');
    $collection->add('../public/js/charisma.js');
});
