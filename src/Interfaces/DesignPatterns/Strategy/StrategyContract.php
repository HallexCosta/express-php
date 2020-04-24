<?php

namespace Express\Interfaces\DesignPatterns\Strategy;

/**
 * class StrategyContract
 */
interface StrategyContract
{
	/**
	 * execute
	 * @param  string $uri
	 * @param  array  $routes
	 * @param  string $requestMethod
	 * @return void
	 */
	public function execute(string $uri, array $routes, string $requestMethod) : void;
}