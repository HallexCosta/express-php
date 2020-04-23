<?php

namespace Router\Strategy;

use Router\Abstracts\Protocol\HTTP;

/**
 * class GET
 */
final class GET extends HTTP
{
	protected function invalidRouteHttpException() : void {}
}