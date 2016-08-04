<?php
/**
 * Service Provider of Laravel Geography package.
 */

namespace Maxyc\Laravel\Geography;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/config.php' => config_path('geography.php')
		]);
	}

	/**
	 * Register service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/config.php', 'geography');

		// Http
		switch(config('geography.services.http.implementation'))
		{
			case 'Guzzle':

				$this->app->bind('Maxyc\Laravel\Geography\Services\Http\HttpInterface', 'Maxyc\Laravel\Geography\Services\Http\GuzzleHttp');

			break;
		}

		$this->app->bind('http', 'Maxyc\Laravel\Geography\Services\Http\HttpInterface');

		// Countries
		switch(config('geography.services.countries.implementation'))
		{
			case 'Geonames':

				$this->app->bind('Maxyc\Laravel\Geography\Services\Countries\CountriesInterface', 'Maxyc\Laravel\Geography\Services\Countries\GeonamesCountries');

			break;
		}

		$this->app->bind('countries', 'Maxyc\Laravel\Geography\Services\Countries\CountriesInterface');

		// Location
		switch(config('geography.services.location.implementation'))
		{
			case 'Telize':

				$this->app->bind('Maxyc\Laravel\Geography\Services\Location\LocationInterface', 'Maxyc\Laravel\Geography\Services\Location\TelizeLocation');

			break;

			case 'Ipapi':

				$this->app->bind('Maxyc\Laravel\Geography\Services\Location\LocationInterface', 'Maxyc\Laravel\Geography\Services\Location\IpapiLocation');

			break;
		}

		$this->app->bind('location', 'Maxyc\Laravel\Geography\Services\Location\LocationInterface');

		// Phones
		switch(config('geography.services.phones.implementation'))
		{
			case 'Restcountries':

				$this->app->bind('Maxyc\Laravel\Geography\Services\Phones\PhonesInterface', 'Maxyc\Laravel\Geography\Services\Phones\RestcountriesPhones');

			break;
		}

		$this->app->bind('phones', 'Maxyc\Laravel\Geography\Services\Phones\PhonesInterface');
	}

}

/* End of file ServiceProvider.php */