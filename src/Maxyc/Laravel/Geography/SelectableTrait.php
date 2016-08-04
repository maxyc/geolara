<?php
/**
 * SelectableTrait allow to prepare data for selects.
 */

namespace Maxyc\Laravel\Geography;

/**
 * Class SelectableTrait
 *
 * @package Maxyc\Laravel\Geography
 */
trait SelectableTrait {

	/**
	 * Prepare data for select.
	 *
	 * @param array $data
	 * @param string $provider
	 * @param string $service
	 *
	 * @return array
	 */
	public function prepareSelect($data, $provider, $service)
	{
		$countries = array();

		if(is_array($data) && count($data) > 0)
		{
			foreach($data as $item)
			{
				$key = config('geography.providers.' . $provider . '.services.' . $service . '.key');
				$title = config('geography.providers.' . $provider . '.services.' . $service . '.title');

				$countries[$item[$key]] = $item[$title];
			}
		}

		return $countries;
	}

}

/* End of file SelectableTrait.php */