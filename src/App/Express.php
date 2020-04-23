<?php

namespace Router\Express;

use Router\Core\RouterCore;
/**
 * class Express
 */
final class Express
{
	final public function router() : RouterCore
	{
		return new RouterCore;
	}
}