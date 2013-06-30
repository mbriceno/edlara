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
/**
 * Custom Less compiling
 */

function autoCompileLess($inputFile, $outputFile) {
  // load the cache
  $cacheFile = $inputFile.".cache";

  if (file_exists($cacheFile)) {
    $cache = unserialize(file_get_contents($cacheFile));
  } else {
    $cache = $inputFile;
  }

  $less = new lessc;
  $newCache = $less->cachedCompile($cache);

  if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
    file_put_contents($cacheFile, serialize($newCache));
    file_put_contents($outputFile, $newCache['compiled']);
  }
}
//var_dump(__DIR__);
$publicdir = __DIR__.'/../../public/';
autoCompileLess('/home/gnanakeethan/git-projects/laravel/public/css/system/parallax.less','/home/gnanakeethan/git-projects/laravel/public/css/system/parallax.css');
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
    $collection->add('../public/js/jquery-2.0.2.min.js');
    $collection->add('../public/js/jquery-migrate-1.2.0.min.js');
    $collection->add('../public/css/bootstrap.min.css');
    $collection->add('../public/css/bootstrap-responsive.min.css');
    $collection->add('../public/js/bootstrap.min.js');
    $collection->add('../public/js/jquery.validate.min.js');
    $collection->add('../public/js/additional-methods.min.js');
})->apply('Less');

Basset::collection('grans', function($collection)
{
    // Collection definition.
    $collection->add('../public/css/system/main.css');
    $collection->add('../public/css/system/parallax.css');
    $collection->add('../public/js/jquery.fittext.js');    
    $collection->add('../public/js/system/parallax.js');
});

