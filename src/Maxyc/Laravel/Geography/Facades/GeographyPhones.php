<?php
/**
 * Facade for Phones service.
 */

namespace Maxyc\Laravel\Geography\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class GeographyPhones
 *
 * @package Maxyc\Laravel\Geography\Facades
 */
class GeographyPhones extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'phones';
	}

}

/* End of file GeographyPhones.php */