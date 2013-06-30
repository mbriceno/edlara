<?php namespace Mews\Captcha;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
//use Illuminate\Html\HtmlBuilder as HTML;
class CaptchaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('mews/captcha');

		require __DIR__ . '/../../routes.php';
		require __DIR__ . '/../../validation.php';
		$app = $this->app;
		$this->addFormMacro();
	    $this->app->finish(function() use ($app)
	    {

	    });
	}
	public function addFormMacro(){
			app('form')->macro('captcha', function($options = array())
				{					
					$image = \Illuminate\Support\Facades\HTML::image(Captcha::img(), 'Captcha Image');
					$label = "<label for=\"captcha\">Enter the Captcha</label> ";
		 			$input = "<input type=\"text\"  name=\"captcha\" id=\"captcha\" autcomplete=\"off\" required/>";
					return $image.$label.$input;
				});
		
	}
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	    $this->app['captcha'] = $this->app->share(function($app)
	    {
	        return Captcha::instance();
	    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('captcha');
	}

}