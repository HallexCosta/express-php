<?php

namespace Express\Interfaces\Router;

/**
 * class RouteCoreContract
 */
interface RouterCoreContract
{
	/**
	 * get
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	public function get(string $route, \Closure $method) : RouterCoreContract;
	/**
	 * post
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	public function post(string $route, \Closure $method) : RouterCoreContract;
	/**
	 * put
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	public function put(string $route, \Closure $method) : RouterCoreContract;
	/**
	 * delete
	 * @param  string   $route
	 * @param  \Closure $method
	 * @return RouterCoreContract
	 */
	public function delete(string $route, \Closure $method) : RouterCoreContract;
	/**
	 * run
	 * @return void
	 */
	public function run() : void;
}