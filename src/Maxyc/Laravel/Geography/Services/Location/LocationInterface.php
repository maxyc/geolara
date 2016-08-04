<?php
/**
 * Interface of Location service.
 */

namespace Maxyc\Laravel\Geography\Services\Location;

/**
 * Interface LocationInterface
 *
 * @package Maxyc\Laravel\Geography\Services\Location
 */
interface LocationInterface {

	/**
	 * Get my location.
	 *
	 * @return bool|array
	 */
	public function my();

	/**
	 * Get visitor IP.
	 *
	 * @return string
	 */
	public function ip();

	/**
	 * Query the API.
	 *
	 * @return bool
	 */
	public function query();

}

/* End of file LocationInterface.php */