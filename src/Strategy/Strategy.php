<?php

namespace Express\Strategy;

use Express\Utils\Helpers;
use Express\Core\HTTP\Request;
use Express\Core\HTTP\Response;
use Express\Interfaces\DesignPatterns\Strategy\StrategyContract;

/**
 * class Strategy
 */
final class Strategy implements StrategyContract
{
	/**
	 * @var const ROUTER_STRATEGY_NAMESPACE
	 */
	private const ROUTER_STRATEGY_NAMESPACE = '\\Express\\Strategy\\';
	/**
	 * execute
	 * @param  string $uri
	 * @param  array $routes
	 * @param  string $requestMethod
	 * @return void
	 */
	final public function execute(string $uri, array $routes, string $requestMethod) : void
	{
		$strategy = static::ROUTER_STRATEGY_NAMESPACE . $requestMethod;
		$http = new $strategy();
		$http->execute($uri, $routes[$requestMethod]);
	}
}