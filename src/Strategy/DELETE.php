<?php

namespace Router\Strategy;

use Router\Abstracts\Protocol\HTTP;

/**
 * class DELETE
 */
final class DELETE extends HTTP
{
	protected function invalidRouteHttpException() : void {}
}