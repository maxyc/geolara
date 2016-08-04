<?php
/**
 * Interface of Phones service.
 */

namespace Maxyc\Laravel\Geography\Services\Phones;

/**
 * Interface PhonesInterface
 *
 * @package Maxyc\Laravel\Geography\Services\Phones
 */
interface PhonesInterface {

	/**
	 * Get list of countries phone codes.
	 *
	 * @return bool|array
	 */
	public function codes();

	/**
	 * Get phone code of a country.
	 *
	 * @param string $country Country code
	 *
	 * @return bool|string
	 */
	public function code($country);

}

/* End of file PhonesInterface.php */