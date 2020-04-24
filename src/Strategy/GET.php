<?php

namespace Express\Strategy;

use Express\Abstracts\Protocol\HTTP;

/**
 * class GET
 */
final class GET extends HTTP
{
	/**
	 * invalidRouteHttpException
	 * @return void
	 */
	protected function invalidRouteHttpException() : void {}
}