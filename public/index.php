<?php

require_once '../bootstrap.php';

use Router\Express\Express;
use Router\Core\HTTP\Request;
use Router\Core\HTTP\Response;

$express = new Express;
$router = $express->router();

$router->get('/', function(Request $request, Response $response) {
	return 'Home Route :D (GET)';
});

$router->post('/', function(Request $request, Response $response) {
	return 'Users Create Route !!! :D (POST)';
});

$router->put('/', function(Request $request, Response $response) {
	return 'Profile Route !!! :D (PUT)';
});

$router->delete('/', function(Request $request, Response $response) {
	return 'User Destroy Route !!! :D (DELETE)';
});

$router->run();