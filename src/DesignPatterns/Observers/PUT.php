<?php

namespace Express\DesignPatterns\Observers;

use Express\Abstracts\Protocol\HTTP;

/**
 * class PUT
 */
final class PUT extends HTTP
{
	/**
	 * Throw exception if it is not a PUT Request
	 * invalidRouteHttpException
	 * @return void
	 */
	public function invalidRouteHttpException() : void
	{
	}
}