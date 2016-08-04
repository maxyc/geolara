<?php
/**
 * Guzzle implementation of HttpInterface.
 */

namespace Maxyc\Laravel\Geography\Services\Http;

use Maxyc\Laravel\Geography\Geography;
use GuzzleHttp\Client;

/**
 * Class GuzzleHttp
 *
 * @package Maxyc\Laravel\Geography\Services\Http
 */
class GuzzleHttp extends Geography implements HttpInterface {

	/**
	 * Client holder.
	 *
	 * @var $client
	 */
	protected $client;

	/**
	 * Constructor.
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * {@inheritdoc}
	 */
	public function client()
	{
		return $this->client;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param object $response
	 */
	public function result($response)
	{
		if($response->getStatusCode() == 200)
		{
			$result = $response->json();

			if(is_array($result) && count($result) > 0)
			{
				return $result;
			}
		}

		return false;
	}

}

/* End of file GuzzleHttp.php */