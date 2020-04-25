<?php

namespace Express\Interfaces\DesignPatterns\Strategy;

/**
 * interface StrategyContract
 */
interface StrategyContract
{
	/**
	 * run
	 * @return StrategyContract
	 */
	public function run() : void;
}