<?php namespace Grans\Checkboxcaptcha;

use Illuminate\Support\ServiceProvider;

class CheckboxcaptchaServiceProvider extends ServiceProvider {

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
		$this->package('grans/checkboxcaptcha');
		$this->addValidator();
		$this->addFormMacro();
	}

	/**
	 * Extends Validator to include a recaptcha type
	 */
	public function addValidator()
	{
		$validator = $this->app['Validator'];
		
		$validator::extend('checkbox_captcha', function($attribute, $value, $parameters)
		{	
			$challenge = app('Input')->get('checkbox_captcha');
			$truth = \Session::get('checkbox_captcha_store');
			if($truth == $challenge)
				return true;
			
			return false;
		});
	}
	
	/**
	 * Extends Form to include a recaptcha macro
	 */
	public function addFormMacro()
	{           
		app('form')->macro('checkbox_captcha', function($options = array())
		{			
			return app('view')->make('checkboxcaptcha::captcha');
		});
	}
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}