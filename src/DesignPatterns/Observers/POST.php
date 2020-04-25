<?php

namespace Express\DesignPatterns\Observers;

use Express\Abstracts\Protocol\HTTP;

/**
 * class POST
 */
final class POST extends HTTP
{
	/**
	 * Throw exception if it is not a POST Request
	 * invalidRouteHttpException
	 * @return void
	 */
	public function invalidRouteHttpException() : void
	{
	}
}