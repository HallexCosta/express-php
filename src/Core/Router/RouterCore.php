<?php

namespace Express\Core\Router;

use Closure;
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
	 * @param  Closure  $method
	 * @return void
	 */
	final public function get(string $route, Closure $method) : void
	{
		$this->attach(new GET($route, $method));
	}
	/**
	 * post
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	final public function post(string $route, Closure $method) : void
	{
		$this->attach(new POST($route, $method));
	}
	/**
	 * put
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	final public function put(string $route, Closure $method) : void
	{
		$this->attach(new PUT($route, $method));
	}
	/**
	 * delete
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	final public function delete(string $route, Closure $method) : void
	{
		$this->attach(new DELETE($route, $method));
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
		$id = spl_object_hash($observer);
		$this->observers->attach($observer, $id);
		return $this;
	}
	/**
	 * detach
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
	final public function requestHTTP() : string
	{
		return $this->requestHTTP;
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