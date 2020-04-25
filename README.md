# Express

### "*Import system route in your project with express*"

<img src="https://user-images.githubusercontent.com/55293671/77607982-b7a2ca80-6efa-11ea-9c59-d82fba2e34d6.png" width="300" alt="octocat-hallex">

## Attention
**Maintenance**
* Request
* Response
* Headers

## How to Use?

#### Required
* composer
* PHP ^7.4

### Guide
* [Install](#install)
* [Usage](#usage)

[](#install)
##  Install

> **composer require hallex/express ^1.0**

[](#usage)
## Usage
```php
require_once __DIR__ . '/vendor/autoload.php';

use Express\Application\Express;
use Express\Core\HTTP\Request;
use Express\Core\HTTP\Response;

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
	return 'Home Route :D (DELETE)';
});
/**
 * Run all routes
 */
$router->run();
```

## Contributor
```json
{
	"name": "Hállex da Silva Costa",
	"age": 17,
	"role": "Developer",
	"startDate": "22/04/2020",
	"latestUpdate": "24/04/2020 20:10"
}
```