<?php

namespace Express\Core\Router;

use Closure;
use SplSubject;
use SplObserver;
use SplObjectStorage;

use Express\{
	Config\Config,
	Core\Exceptions\RouteNotDefinedException,
	Strategy\Strategy
};
use Express\Interfaces\{
	DesignPatterns\Singleton\SingletonContract,
	Router\RouterCoreContract
};
use Express\DesignPatterns\Observers\{
	DELETE,
	GET,
	POST,
	PUT
};

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
	 * @var array $validRoutes;
	 */
	private array $validRoutes;
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
		$this->run();
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
		$this->setValidRoutes(strtoupper(__FUNCTION__), $route);
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
		$this->setValidRoutes(strtoupper(__FUNCTION__), $route);
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
		$this->setValidRoutes(strtoupper(__FUNCTION__), $route);
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
		$this->setValidRoutes(strtoupper(__FUNCTION__), $route);
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
	final private function run() : void
	{
		$this->notify();
		if (!in_array($this->uri, $this->validRoutes()))
			$this->routeInvalidException();
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
	 * routeInvalidException
	 * @return void
	 */
	final private function routeInvalidException() : void
	{
		try {
			throw new RouteNotDefinedException(
				sprintf(
					'Error: The route "%s" has not been defined as %s',
					$this->uri,
					$this->requestMethod
				)
			);
		} catch(RouteNotDefinedException $e) {
			echo $e->getMessage();
		}
	}
	/**
	 * normalizeURI
	 * @param  string $route
	 * @return string
	 */
	final private function normalizeURI(string $route) : string
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
	 * Get method HTTP
	 * requestMethod
	 * @return string
	 */
	final public function requestMethod() : string
	{
		return $this->requestMethod;
	}
	/**
	 * setValidRoutes
	 * @return void
	 */
	final public function setValidRoutes(string $requestMethodHTTPInvoked, string $route) : void
	{
		$this->validRoutes[$requestMethodHTTPInvoked][] = $route;
	}
	/**
	 * validRoutes
	 * @return array
	 */
	final public function validRoutes() : array
	{
		return $this->validRoutes[$this->requestMethod];
	}
	/**
	 * debug
	 * @return void
	 */
	final private function debug()
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