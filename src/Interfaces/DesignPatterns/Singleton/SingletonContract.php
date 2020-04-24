<?php

namespace Express\Interfaces\DesignPatterns\Singleton;

/**
 * class SingletonContract
 */
interface SingletonContract
{
	/**
	 * instance
	 * @return SingletonContract
	 */
	public static function instance() : SingletonContract;
}