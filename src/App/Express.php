<?php

namespace Express\Application;

use Express\{
	Core\Router\RouterCore,
	Interfaces\Router\RouterCoreContract
};

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