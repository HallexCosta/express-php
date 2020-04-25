<?php

namespace Express\DesignPatterns\Observers;

use Express\Abstracts\Protocol\Http;

/**
 * class GET
 */
final class GET extends HTTP
{
	/**
	 * Throw exception if it is not a GET Request
	 * invalidRouteHttpException
	 * @return void
	 */
	public function invalidRouteHttpException() : void
	{
	}
}