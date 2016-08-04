<?php
/**
 * CacheTrait allow to cache and get cached data.
 */

namespace Maxyc\Laravel\Geography;

/**
 * Class CacheTrait
 *
 * @package Maxyc\Laravel\Geography
 */
trait CacheTrait {

	/**
	 * Get cached data.
	 *
	 * @param string $index
	 *
	 * @return bool|array
	 */
	public function getCache($index)
	{
		if(\Cache::has($index))
		{
			return unserialize(\Cache::get($index));
		}

		return false;
	}

	/**
	 * Cache the data.
	 *
	 * @param string $index
	 * @param array $data
	 * @param bool|int $period Hours
	 *
	 * @return bool
	 */
	public function setCache($index, $data, $period = false)
	{
		if( ! $this->getCache($index))
		{
			$data = serialize($data);

			if( ! $period)
			{
				\Cache::forever($index, $data);
			}
		}

		return false;
	}

}

/* End of file CacheTrait.php */