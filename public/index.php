<?php

require_once '../bootstrap.php';

use Router\Express\Express;
use Router\Core\HTTP\Request;
use Router\Core\HTTP\Response;

$express = new Express;
$router = $express->router();

/**
 * Build route: get
 */
$router->get('/', function(Request $request, Response $response) {
	return 'Home Route :D (GET)';
});
/**
 * Build route: post
 */
$router->post('/', function(Request $request, Response $response) {
	return 'Home Route :D (POST)';
});
/**
 * Build route: put
 */
$router->put('/', function(Request $request, Response $response) {
	return 'Home Route :D (PUT)';
});
/**
 * Build route: delete
 */
$router->delete('/', function(Request $request, Response $response) {
	return 'Home Route :D(DELETE)';
});
/**
 * Run all routes
 */
$router->run();