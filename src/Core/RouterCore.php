<?php

namespace Router\Core;

use Router\Utils\Helpers;
use Router\Strategy\Strategy;
use Router\Interfaces\Router\RouterCoreContract;
use Router\Interfaces\DesignPatterns\Singleton\SingletonContract;

/**
 * class RouteCore
 */
final class RouterCore implements RouterCoreContract, SingletonContract
{
	/**
	 * @var RouterCoreContract|nullable $instance
	 */
	private static ?RouterCoreContract $instance = null;
	/**
	 * @var string $uri
	 */
	private string $uri;
	/**
	 * @var string $requestMethod
	 */
	private string $requestMethod;
	/**
	 * @var array $observers
	 */
	private array $observers;
	/**
	 * instance
	 * @return SingletonContract
	 */
	final public static function instance() : SingletonContract
	{
		return static::$instance ??= new static();
	}
	/**
	 * __construct
	 */
	final private function __construct()
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
	/**
	 * get
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	final public function get(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('GET', $route, $method);
		return $this;
	}
	/**
	 * post
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	final public function post(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('POST', $route, $method);
		return $this;
	}
	/**
	 * put
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	final public function put(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('PUT', $route, $method);
		return $this;
	}
	/**
	 * delete
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	final public function delete(string $route, \Closure $method) : RouterCoreContract
	{
		$this->attach('DELETE', $route, $method);
		return $this;
	}
	/**
	 * run
	 * @return void
	 */
	final public function run() : void
	{
		$this->strategy->execute($this->uri, $this->observers(), $this->requestMethod);
	}
	/**
	 * attach
	 * @param  string   $requestMethod
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	final public function attach(
		string $requestMethod,
		string $route,
		\Closure $method
	) : RouterCoreContract
	{
		$this->observers[$requestMethod][$route] = $method;
		return $this;
	}
	/**
	 * detach
	 * @param  string $requestMethod
	 * @param  string $route
	 * @return RouterCoreContract
	 */
	final public function detach(string $requestMethod, string $route) : RouterCoreContract
	{
		unset($this->observers[$requestMethod][$route]);
		return $this;
	}
	/**
	 * observers
	 * @return array
	 */
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
    /**
	 * __wakeup
	 */
    private function __wakeup()
    {
    }
    /**
	 * __clone
	 */
    private function __clone()
    {
    }
}