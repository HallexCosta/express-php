<?php

namespace Express\Abstracts\Protocol;

use Closure;
use SplSubject;
use SplObserver;
use Exception;

use Express\Core\{
	Exceptions\RouteNotDefinedException,
	HTTP\Request,
	HTTP\Response
};
use Express\Interfaces\{
	DesignPatterns\Strategy\StrategyContract,
	Protocol\HTTPContract
};


/**
 * class HTTP
 */
class HTTP implements HTTPContract, StrategyContract, SplObserver
{
	/**
	 * __construct
	 * @param string  $route
	 * @param Closure $method
	 */
	final public function __construct(string $route, Closure $method)
	{
		$this->route = $route;
		$this->method = $method;
	}
	/**
	 * update
	 * @param  SplSubject $subject
	 * @return void
	 */
	final public function update(SplSubject $subject) : void
	{
		$this->verifyURI($subject->uri()) && $this->verifyRequestMethod($subject->requestMethod())
		? $this->run() : null;
	}
	/**
	 * run
	 * @return void
	 */
	final public function run() : void
	{
		$method = ($this->method)(new Request, new Response);
		empty($method)
		? print "{$this->requestMethodHTTPInvoked()}: {$this->route}"
		: print $method;

	}
	/**
	 * verifyURI
	 * @param  string $uri
	 * @param  string $requestMethod
	 * @return bool
	 */
	final public function verifyURI(string $uri) : bool
	{
		return $uri === $this->route
		? true : false;
	}
	/**
	 * verifyRequestMethod
	 * @return bool
	 */
	final public function verifyRequestMethod(string $requestMethod) : bool
	{
		return $requestMethod === $this->requestMethodHTTPInvoked()
		? true : false;
	}
	/**
	 * requestMethodHTTPInvoked
	 * @return string
	 */
	final public function requestMethodHTTPInvoked() : string
	{
		$methodHTTP = explode('\\', get_called_class());
		return strtoupper(array_pop($methodHTTP));
	}
}