<?php

namespace Router\Express;

use Router\Core\RouterCore;
use Router\Interfaces\Router\RouterCoreContract;

/**
 * class Express
 */
final class Express
{
	/**
	 * router
	 * @return RouterCoreContract
	 */
	final public function router() : RouterCoreContract
	{
		return RouterCore::instance();
	}
}