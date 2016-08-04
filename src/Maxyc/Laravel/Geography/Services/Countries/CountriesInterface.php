<?php
/**
 * Interface of Countries service.
 */

namespace Maxyc\Laravel\Geography\Services\Countries;

/**
 * Interface CountriesInterface
 *
 * @package Maxyc\Laravel\Geography\Services\Countries
 */
interface CountriesInterface {

	/**
	 * Get list of all available countries.
	 *
	 * @return array|bool
	 */
	public function all();

	/**
	 * Get all countries for select input.
	 *
	 * @return array
	 */
	public function allSelect();

	/**
	 * Get particular country data.
	 *
	 * @param string $key
	 *
	 * @return array|bool
	 */
	public function get($key);

}

/* End of file CountriesInterface.php */