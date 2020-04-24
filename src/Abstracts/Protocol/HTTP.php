<?php

namespace Express\Abstracts\Protocol;

use Express\Core\HTTP\Request;
use Express\Core\HTTP\Response;
use Express\Interfaces\Protocol\HTTPContract;

/**
 * class HTTP
 */
abstract class HTTP implements HTTPContract
{
	/**
	 * invalidRouteHttpException
	 * @return void
	 */
	abstract protected function invalidRouteHttpException() : void;
	/**
	 * execute
	 * @param  string $uri
	 * @param  array  $routes
	 * @return void
	 */
	final public function execute(string $uri, array $routes) : void
	{
		if ($this->verify($uri, $routes)) {
			echo call_user_func_array(
				$routes[$uri],
				['request' => new Request, 'response' => new Response]
			);
		} else {
			$this->invalidRouteHttpException();
			//throw new \InvalidRouteHttpRequestPost("404 not found");
		}
	}
	/**
	 * verify
	 * @param  string $uri
	 * @param  array  $routes
	 * @return bool
	 */
	final private function verify(string $uri, array $routes) : bool
	{
		if (in_array($uri, array_keys($routes))) {
			return true;
		}
		return false;
	}
}