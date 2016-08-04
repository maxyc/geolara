<?php
/**
 * Ipapi implementation of LocationInterface.
 */

namespace Maxyc\Laravel\Geography\Services\Location;

use Maxyc\Laravel\Geography\Geography;
use Maxyc\Laravel\Geography\Services\Http\HttpInterface;

/**
 * Class IpapiLocation
 *
 * @package Maxyc\Laravel\Geography\Services\Location
 */
class IpapiLocation extends Geography implements LocationInterface {

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
	protected $url = 'http://ip-api.com/json/';

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

				if($result && array_key_exists('lat', $result) && array_key_exists('lon', $result) && array_key_exists('countryCode', $result))
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

/* End of file IpapiLocation.php */