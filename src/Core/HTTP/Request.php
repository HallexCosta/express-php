<?php

namespace Express\Core\HTTP;

/**
 * class Request
 */
final class Request
{
	/**
	 * getBody
	 * @return mixed
	 */
	final public function getBody()
	{
		return file_get_contents('php://input');
	}
}