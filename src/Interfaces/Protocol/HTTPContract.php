<?php

namespace Express\Interfaces\Protocol;

/**
 * class HTTPContract
 */
interface HTTPContract
{
	/**
	 * run
	 * @return void
	 */
	public function run() : void;
	/**
	 * verify
	 * @param  string $uri
	 * @param  string $requestMethod
	 * @return bool
	 */
	public function verify(string $uri, string $requestMethod) : bool;
	/**
	 * requestMethodHTTPInvoked
	 * @return string
	 */
	public function requestMethodHTTPInvoked() : string;
	/**
	 * Throw exception if it is not a GET, POST, PUT or DELETE Request
	 * invalidHTTPRoute
	 * @param	string $uri
	 * @param	string $requestMethod
	 * @return	void
	 */
	public function invalidHTTPRoute(string $uri, string $requestMethod) : void;
}