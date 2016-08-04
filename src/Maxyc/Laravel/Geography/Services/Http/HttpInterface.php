<?php
/**
 * Interface of Http service.
 */

namespace Maxyc\Laravel\Geography\Services\Http;

/**
 * Interface HttpInterface
 *
 * @package Maxyc\Laravel\Geography\Services\Http
 */
interface HttpInterface {

	/**
	 * Access HTTP client.
	 *
	 * @return object
	 */
	public function client();

	/**
	 * Prepare response result.
	 *
	 * @param object $response
	 *
	 * @return array|bool
	 */
	public function result($response);

}

/* End of file HttpInterface.php */