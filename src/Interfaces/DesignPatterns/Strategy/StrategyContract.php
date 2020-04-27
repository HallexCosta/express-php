<?php

namespace Express\Interfaces\DesignPatterns\Strategy;

/**
 * interface StrategyContract
 */
interface StrategyContract
{
	/**
	 * requestMethodHTTPInvoked
	 * @return StrategyContract
	 */
	public function requestMethodHTTPInvoked() : string;
}