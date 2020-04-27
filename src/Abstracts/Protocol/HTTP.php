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
abstract class HTTP implements SplObserver, StrategyContract, HTTPContract
{
	/**
	 * Throw exception if it is not a GET,POST, PUT or DELETE Request
	 * invalidHTTPRoute
	 * @param	string $uri
	 * @param	string $requestMethod
	 * @return	void
	 */
	public function invalidHTTPRoute(string $uri, string $requestMethod) : void
	{
		$isCurrentHTTPMethod = $requestMethod === $this->requestMethodHTTPInvoked();
		if ($isCurrentHTTPMethod) {
			throw new RouteNotDefinedException(
				sprintf(
					'<b>Error:</b> The route <b>"%s"</b> has not been defined as <b>%s</b>',
					$uri,
					$requestMethod
				)
			);
		}
	}
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
		try {
			$this->verify($subject->uri(), $subject->requestMethod())
			? $this->run()
			: $this->invalidHTTPRoute($subject->uri(), $subject->requestMethod());
		} catch(Exception $e) {
			echo '<pre>';
			print $e->getMessage();
		}
	}
	/**
	 * run
	 * @return void
	 */
	final public function run() : void
	{
		echo ($this->method)(new Request, new Response);
	}
	/**
	 * verify
	 * @param  string $uri
	 * @param  string $requestMethod
	 * @return bool
	 */
	final public function verify(string $uri, string $requestMethod) : bool
	{
		return $uri === $this->route
		&&
		$requestMethod === $this->requestMethodHTTPInvoked()
		? true : false;
	}
	/**
	 * requestMethodHTTPInvoked
	 * @return string
	 */
	final public function requestMethodHTTPInvoked() : string
	{
		$methodHTTP = explode('\\', get_called_class());
		return array_pop($methodHTTP);
	}
}