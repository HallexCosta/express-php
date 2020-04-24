<?php

namespace Router\Strategy;

use Router\Utils\Helpers;
use Router\Core\HTTP\Request;
use Router\Core\HTTP\Response;
use Router\Interfaces\DesignPatterns\Strategy\StrategyContract;

/**
 * class Strategy
 */
final class Strategy implements StrategyContract
{
	/**
	 * @var const ROUTER_STRATEGY_NAMESPACE
	 */
	private const ROUTER_STRATEGY_NAMESPACE = '\\Router\\Strategy\\';
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