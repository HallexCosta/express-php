<?php

namespace Express\DesignPatterns\Observers;

use Express\Abstracts\Protocol\HTTP;

/**
 * class DELETE
 */
final class DELETE extends HTTP
{
	/**
	 * Throw exception if it is not a DELETE Request
	 * invalidRouteHttpException
	 * @return void
	 */
	public function invalidRouteHttpException() : void
	{
	}
}