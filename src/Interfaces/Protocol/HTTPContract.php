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
	 * verifyURI
	 * @param  string $uri
	 * @return bool
	 */
	public function verifyURI(string $uri) : bool;
	/**
	 * verifyURI
	 * @param  string $requestMethod
	 * @return bool
	 */
	public function verifyRequestMethod(string $requestMethod) : bool;
	/**
	 * requestMethodHTTPInvoked
	 * @return string
	 */
	public function requestMethodHTTPInvoked() : string;
}