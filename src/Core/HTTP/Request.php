<?php

namespace Express\Core\HTTP;

/**
 * class Request
 */
final class Request
{
	/**
	 * body
	 * @return mixed
	 */
	final public function body()
	{
		return file_get_contents('php://input');
	}
}