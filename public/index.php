<?php

require_once '../bootstrap.php';

use Express\Application\Express;
use Express\Core\{
	HTTP\Request,
	HTTP\Response
};

$app = new Express;
$router = $app->router();

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
	return 'Home Route :D (DELETE)';
});
/**
 * Run all routes
 */
$router->run();