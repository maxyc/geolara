<?php
/**
 * Telize implementation of LocationInterface.
 */

namespace Maxyc\Laravel\Geography\Services\Location;

use Maxyc\Laravel\Geography\Geography;
use Maxyc\Laravel\Geography\Services\Http\HttpInterface;

/**
 * Class TelizeLocation
 *
 * @package Maxyc\Laravel\Geography\Services\Location
 */
class TelizeLocation extends Geography implements LocationInterface {

	use \Maxyc\Laravel\Geography\CookieTrait;

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
	protected $url = 'http://www.telize.com/geoip/';

	/**
	 * Constructor.
	 */
	public function __construct(HttpInterface $http)
	{
		$this->http = $http;
	}

	/**
	 * {@inheritdoc}
	 */
	public function my()
	{
		$location = $this->query();

		return $location;
	}

	/**
	 * {@inheritdoc}
	 */
	public function ip()
	{
		return \Request::getClientIp();
	}

	/**
	 * {@inheritdoc}
	 */
	public function query()
	{
		$location = $this->getCookie('location_' . $this->ip());

		if( ! $location)
		{
			try
			{
				$response = $this->http->client()->get($this->url . $this->ip());
				$result = $this->http->result($response);

				if($result && array_key_exists('longitude', $result) && array_key_exists('latitude', $result) && array_key_exists('country_code', $result))
				{
					$location = $result;

					$this->setCookie('location_' . $this->ip(), $location);
				}
			}
			catch(\Exception $exception)
			{
				\Log::error($exception->getMessage());
			}
		}

		return $location;
	}

}

/* End of file TelizeLocation.php */