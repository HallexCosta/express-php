<?php

namespace Router\Strategy;

use Router\Abstracts\Protocol\HTTP;

/**
 * class PUT
 */
final class PUT extends HTTP
{
	protected function invalidRouteHttpException() : void {}
}