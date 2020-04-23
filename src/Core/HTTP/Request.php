<?php

namespace Router\Core\HTTP;

/**
 * class Request
 */
final class Request
{
	final public function getBody()
	{
		return file_get_contents('php://input');
	}
}