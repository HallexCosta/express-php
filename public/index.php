<?php

require_once '../bootstrap.php';

use Express\Application\Express;

$app = new Express;
$router = $app->router();

$app->use('./routes.php');
