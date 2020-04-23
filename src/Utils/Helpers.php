<?php

namespace Router\Utils;

/**
 * class Helpers
 */
final class Helpers
{
	/**
	 * dd
	 * @param  mixed  $dump
	 * @param  boolean $die
	 * @return void
	 */
	final public static function dd($dump, $die = true) : void
	{
		var_dump($dump);
		$die === true ? exit : null;
	}
}