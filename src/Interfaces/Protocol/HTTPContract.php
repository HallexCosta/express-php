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
}