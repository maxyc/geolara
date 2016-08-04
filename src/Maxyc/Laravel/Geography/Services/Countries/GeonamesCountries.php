<?php
/**
 * Geonames implementation of CountriesInterface.
 */

namespace Maxyc\Laravel\Geography\Services\Countries;

use Maxyc\Laravel\Geography\Geography;
use Maxyc\Laravel\Geography\Services\Http\HttpInterface;

/**
 * Class GeonamesCountries
 *
 * @package Maxyc\Laravel\Geography\Services\Countries
 */
class GeonamesCountries extends Geography implements CountriesInterface {

	use \Maxyc\Laravel\Geography\CacheTrait;
	use \Maxyc\Laravel\Geography\SelectableTrait;

	/**
	 * Http service holder.
	 *
	 * @var $http
	 */
	protected $http;

	/**
	 * URL holder.
	 *
	 * @var $url
	 */
	protected $url = 'http://api.geonames.org/';

	/**
	 * Params holder.
	 *
	 * @var $params
	 */
	protected $params = '';

	/**
	 * Constructor.
	 */
	public function __construct(HttpInterface $http)
	{
		$this->http = $http;
		$this->params = 'username=' . config('geography.providers.Geonames.username') . '&lang=' . \App::getLocale();
	}

	/**
	 * {@inheritdoc}
	 */
	public function all()
	{
		$countries = $this->getCache('countries_' . \App::getLocale());

		if( ! $countries)
		{
			try
			{
				$response = $this->http->client()->get($this->url . 'countryInfoJSON?' . $this->params);
				$result = $this->http->result($response);

				if($result && array_key_exists('geonames', $result))
				{
					$result = $result['geonames'];
					$countries = array();

					foreach($result as $country)
					{
						$countries[$country[config('geography.providers.Geonames.services.countries.key')]] = $country;
					}

					$this->setCache('countries_' . \App::getLocale(), $countries);

					return $countries;
				}
			}
			catch(Exception $exception)
			{
				\Log::error($exception->getMessage());
			}
		}

		return $countries;
	}

	/**
	 * {@inheritdoc}
	 */
	public function allSelect()
	{
		$countries = $this->getCache('countries_select_' . \App::getLocale());

		if( ! $countries)
		{
			$countries = $this->prepareSelect($this->all(), 'Geonames', 'countries');

			$this->setCache('countries_select_' . \App::getLocale(), $countries);
		}

		return $countries;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param string $key
	 */
	public function get($key)
	{
		$countries = $this->all();

		if(is_array($countries) && array_key_exists($key, $countries))
		{
			return $countries[$key];
		}

		return false;
	}

}

/* End of file GeonamesCountries.php */