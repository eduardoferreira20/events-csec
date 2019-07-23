<?php namespace Miqueiasdesouza\Boleto\Laravel\v4;

use Illuminate\Support\ServiceProvider;

class BoletoServiceProvider extends ServiceProvider {

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
		$this->package('miqueiasdesouza/boleto');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['boleto'] = $this->app->share(function($app)
		{
			return new Boleto;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('boleto');
	}

}
