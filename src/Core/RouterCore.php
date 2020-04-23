<?php

namespace Router\Core;

use Router\Utils\Helpers;
use Router\Strategy\Strategy;
use Router\Interfaces\RouterCoreContract;

/**
 * class RouteCore
 */
final class RouterCore implements RouterCoreContract
{
	/**
	 * @var string $uri
	 */
	private string $uri;
	/**
	 * @var arrat $observers
	 */
	private array $observers;
	/**
	 * @var string $requestMethod
	 */
	private string $requestMethod;
	/**
	 * __construct
	 */
	final public function __construct()
	{
		$this->initialize();
		$this->strategy = new Strategy;
	}
	/**
	 * __destruct()
	 */
	final public function __destruct()
	{
		//$this->strategy->execute($this->uri, $this->observers(), $this->requestMethod);
		$this->debug();
	}
	final private function initialize() : void
	{
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
	}
	final public function run() : void
	{
		$this->strategy->execute($this->uri, $this->observers(), $this->requestMethod);
	}
	final public function get(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('GET', $route, $method);
		return $this;
	}
	final public function post(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('POST', $route, $method);
		return $this;
	}
	final public function put(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('PUT', $route, $method);
		return $this;
	}
	final public function delete(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('DELETE', $route, $method);
		return $this;
	}
	final public function attach(string $requestMethod, string $route, \Closure $method) : RouterCoreContract
	{
		$this->observers[$requestMethod][$route] = $method;
		return $this;
	}
	final public function detach(string $requestMethod, string $route) : RouterCoreContract
	{
		unset($this->observers[$requestMethod][$route]);
		return $this;
	}
	final public function observers() : array
	{
		return $this->observers;
	}
	/**
	 * normalizeURI
	 * @param  string $route
	 * @return string
	 */
	final public function normalizeURI(string $route) : string
	{
		$route = rtrim($route, '/');
		return $route === '' ? '/' : $route;
	}
	/**
	 * debug
	 * @return void
	 */
	final public function debug()
	{
		if (DEBUG_CLASS_ROUTE_CORE) {
			foreach ($this as $property) {
				Helpers::dd($property, false);
			}
		}
	}
}