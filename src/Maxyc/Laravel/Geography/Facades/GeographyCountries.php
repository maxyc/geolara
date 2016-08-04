<?php
/**
 * Facade for Countries service.
 */

namespace Maxyc\Laravel\Geography\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class GeographyCountries
 *
 * @package Maxyc\Laravel\Geography\Facades
 */
class GeographyCountries extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'countries';
	}

}

/* End of file GeographyCountries.php */