<?php

namespace Express\Interfaces\Express;

use Express\Interfaces\Router\RouterCoreContract;

/**
 * class ExpressContract
 */
interface ExpressContract
{
	/**
	 * router
	 * @return void
	 */
	public function router() : RouterCoreContract;
	/**
	 * use
	 * @param  string $routerCore
	 * @return void
	 */
	public function use(string $routes) : void;
}