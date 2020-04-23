<?php

namespace Router\Strategy;

use Router\Abstracts\Protocol\HTTP;

/**
 * class POST
 */
final class POST extends HTTP
{
	protected function invalidRouteHttpException() : void {}
}