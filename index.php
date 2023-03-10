<?php

define('DEBUG', false);

require './src/utils/helpers.php';
require './src/Express.php';

$router = new Express();

$router->get('/users/:id/role/:roleId', function () {
  return 'POST /users foi chamado';
});
// $router->post('/users/:id/role/:roleId', function () {
//   return 'POST /users foi chamado';
// });
$router->get('/php-info', function () {
  phpinfo();
});
$router->get('/users', function () {
  return 'GET /users foi chamado';
});
$router->get('/incidents', function () {
  return 'GET /incidents foi chamado';
});

// $router->notify();