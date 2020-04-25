<?php

namespace Express\Core\Router;

use SplSubject;
use SplObserver;
use SplObjectStorage;
use Express\Config\Config;
use Express\Utils\Helpers;
use Express\Strategy\Strategy;
use Express\DesignPatterns\Observers\GET;
use Express\DesignPatterns\Observers\PUT;
use Express\DesignPatterns\Observers\POST;
use Express\DesignPatterns\Observers\DELETE;
use Express\Interfaces\Router\RouterCoreContract;
use Express\Interfaces\DesignPatterns\Singleton\SingletonContract;

/**
 * class RouteCore
 */
final class RouterCore implements RouterCoreContract, SingletonContract, SplSubject
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
	 * @var SplObjectStorage $observers
	 */
	private SplObjectStorage $observers;
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
		$this->observers = new SplObjectStorage;
		$this->initialize();
	}
	/**
	 * __destruct
	 */
	final public function __destruct()
	{
		$this->debug();
	}
	/**
	 * initialize
	 * @return void
	 */
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
		$observer = new GET($route, $method);
		$isGetRequest = $this->requestMethod() === strtoupper(__FUNCTION__);
		if ($isGetRequest) {
			$this->attach($observer);
		}
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
		$observer = new POST($route, $method);
		$isPostRequest = $this->requestMethod() === strtoupper(__FUNCTION__);
		if ($isPostRequest) {
			$this->attach($observer);
		}
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
		$observer = new PUT($route, $method);
		$isPostRequest = $this->requestMethod() === strtoupper(__FUNCTION__);
		if ($isPostRequest) {
			$this->attach($observer);
		}
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
		$observer = new DELETE($route, $method);
		$isPostRequest = $this->requestMethod() === strtoupper(__FUNCTION__);
		if ($isPostRequest) {
			$this->attach($observer);
		}
		return $this;
	}
	/**
	 * notify
	 * @return void
	 */
	final public function notify() : void
	{
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}
	}
	/**
	 * run
	 * @return void
	 */
	final public function run() : void
	{
		$this->notify();
	}
	/**
	 * attach
	 * @param  SplObserver   $observer
	 * @return SplSubject
	 */
	final public function attach(SplObserver $observer) : SplSubject
	{
		$this->observers->attach($observer);
		return $this;
	}
	/**
	 * detach
	 * @param  string $requestMethod
	 * @param  string $route
	 * @return RouterCoreContract
	 */
	final public function detach(SplObserver $observer) : SplSubject
	{
		$this->observers->detach($observer);
		return $this;
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
	 * Get URI
	 * uri
	 * @return string
	 */
	final public function uri() : string
	{
		return $this->uri;
	}
	/**
	 * requestMethod
	 * @return string
	 */
	final public function requestMethod() : string
	{
		return $this->requestMethod;
	}
	/**
	 * debug
	 * @return void
	 */
	final public function debug()
	{
		if (Config::DEBUG_CLASS_ROUTE_CORE) {
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