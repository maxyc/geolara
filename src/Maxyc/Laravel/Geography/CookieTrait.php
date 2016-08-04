<?php
/**
 * CookieTrait allow to cache and get cached data.
 */

namespace Maxyc\Laravel\Geography;

/**
 * Class CookieTrait
 *
 * @package Maxyc\Laravel\Geography
 */
trait CookieTrait {

	/**
	 * Get data from the cookied.
	 *
	 * @param string $index
	 *
	 * @return bool|array
	 */
	public function getCookie($index)
	{
		if(\Cookie::has($index))
		{
			return unserialize(\Cookie::get($index));
		}

		return false;
	}

	/**
	 * Store data in the cookie.
	 *
	 * @param string $index
	 * @param array $data
	 * @param bool|int $period Hours
	 *
	 * @return bool
	 */
	public function setCookie($index, $data, $period = false)
	{
		if( ! $this->getCookie($index))
		{
			$data = serialize($data);

			if( ! $period)
			{
				\Cookie::forever($index, $data);
			}
		}

		return false;
	}

}

/* End of file CookieTrait.php */