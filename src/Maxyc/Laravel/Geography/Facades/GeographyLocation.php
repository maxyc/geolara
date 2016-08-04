<?php
/**
 * Facade for Location service.
 */

namespace Maxyc\Laravel\Geography\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class GeographyLocation
 *
 * @package Maxyc\Laravel\Geography\Facades
 */
class GeographyLocation extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'location';
	}

}

/* End of file GeographyLocation.php */