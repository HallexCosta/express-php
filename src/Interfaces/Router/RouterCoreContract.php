<?php

namespace Express\Interfaces\Router;

use Closure;

/**
 * class RouteCoreContract
 */
interface RouterCoreContract
{
	/**
	 * get
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	public function get(string $route, Closure $method) : void;
	/**
	 * post
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	public function post(string $route, Closure $method) : void;
	/**
	 * put
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	public function put(string $route, Closure $method) : void;
	/**
	 * delete
	 * @param  string   $route
	 * @param  Closure  $method
	 * @return void
	 */
	public function delete(string $route, Closure $method) : void;
	/**
	 * routeInvalidException
	 * @return void
	 */
	public function routeInvalidException() : void;
	/**
	 * run
	 * @return void
	 */
	public function run() : void;
}