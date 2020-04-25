<?php

namespace Express\Abstracts\Protocol;

use Closure;
use SplSubject;
use SplObserver;

use Express\Core\HTTP\Request;
use Express\Core\HTTP\Response;
use Express\Interfaces\Protocol\HTTPContract;
use Express\Interfaces\DesignPatterns\Strategy\StrategyContract;


/**
 * class HTTP
 */
abstract class HTTP implements SplObserver, StrategyContract, HTTPContract
{
	/**
	 * Throw exception if it is not a GET, POST, PUT or Delete Request
	 * invalidRouteHttpException
	 * @return void
	 */
	abstract protected function invalidRouteHttpException() : void;
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
		$isCurrentRoute = $subject->uri() === $this->route;
		if ($isCurrentRoute) {
			$this->run();
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
}