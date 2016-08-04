<?php
/**
 * Restcountries implementation of PhonesInterface.
 */

namespace Maxyc\Laravel\Geography\Services\Phones;

use Maxyc\Laravel\Geography\Geography;
use Maxyc\Laravel\Geography\Services\Http\HttpInterface;
use Maxyc\Laravel\Geography\Services\Countries\CountriesInterface;

/**
 * Class RestcountriesPhones
 *
 * @package Maxyc\Laravel\Geography\Services\Phones
 */
class RestcountriesPhones extends Geography implements PhonesInterface {

	use \Maxyc\Laravel\Geography\CacheTrait;
	use \Maxyc\Laravel\Geography\SelectableTrait;

	/**
	 * Http service holder.
	 *
	 * @var $http
	 */
	protected $http;

	/**
	 * Countries service holder.
	 *
	 * @var $countries
	 */
	protected $countries;

	/**
	 * URL holder.
	 *
	 * @var $url
	 */
	protected $url = 'http://restcountries.eu/rest/v1';

	/**
	 * Constructor.
	 */
	public function __construct(
		HttpInterface $http,
		CountriesInterface $countries
	)
	{
		$this->http = $http;
		$this->countries = $countries;
	}

	/**
	 * {@inheritdoc}
	 */
	public function codes()
	{
		$codes = $this->getCache('phone_codes');

		if( ! $codes)
		{
			try
			{
				$codes = array();
				$countries = $this->countries->all();

				if($countries && ! empty($countries))
				{
					$response = $this->http->client()->get($this->url);
					$result   = $this->http->result($response);

					if($result)
					{
						$result = $response->json();

						foreach($result as $country)
						{
							if(array_key_exists($country['alpha2Code'], $countries))
							{
								if(isset($country['callingCodes'][0]) && ! empty($country['callingCodes'][0]))
								{
									$codes[$country['alpha2Code']] = '+' . $country['callingCodes'][0];
								}
							}
						}
					}
				}

				if(empty($codes))
					$codes = false;
			}
			catch(Exception $exception)
			{
				\Log::error($exception->getMessage());
			}
		}

		return $codes;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param string $country Country code
	 */
	public function code($country)
	{
		$codes = $this->codes();

		if($codes)
		{
			if(array_key_exists($country, $codes))
			{
				return $codes[$country];
			}
		}

		return false;
	}

}

/* End of file RestcountriesPhones.php */