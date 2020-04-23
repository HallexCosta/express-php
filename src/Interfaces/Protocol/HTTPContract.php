<?php

namespace Router\Interfaces\Protocol;

/**
 * class HTTPContract
 */
interface HTTPContract
{
	/**
	 * execute
	 * @param  string $uri
	 * @param  array  $routes
	 * @param  string $requestMethod
	 * @return void
	 */
	public function execute(string $uri, array $routes) : void;
}