<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Package Services
	|--------------------------------------------------------------------------
	|
	| Variables related to services of this package are listed below.
	|
	*/
	'services' => array(

		'http' => array(
			'implementation' => 'Guzzle', // Options: Guzzle
		),

		'countries' => array(
			'implementation' => 'Geonames', // Options: Geonames
		),

		'location' => array(
			'implementation' => 'Telize', // Options: Telize, Ipapi
		),

		'phones' => array(
			'implementation' => 'Restcountries', // Options: Restcountries
		),

	),

	/*
	|--------------------------------------------------------------------------
	| API Providers
	|--------------------------------------------------------------------------
	|
	| Variables related to API providers used in this package are listed below.
	|
	*/

	'providers' => array(

		'Geonames' => array(

			'username' => env('GEO_GEONAMES_USERNAME'),
			'services' => array(

				'countries' => array(
					'key' 	=> 'countryCode', // Array key
					'title' => 'countryName', // Title field
				),

			),

		),

	),

];

/* End of file config.php */