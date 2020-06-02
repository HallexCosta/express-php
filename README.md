
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
> **Public folder content is an example of how to use Express correctly**
```php
require_once __DIR__ . '/vendor/autoload.php';

use Express\Application\Express;
use Express\Core\HTTP\{
	Request,
	Response
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
 * Run all routes automatized
 */
```

# Author
| [<img src="https://avatars2.githubusercontent.com/u/55293671?s=200&v=4"><br><sub>@HallexCosta</sub>](https://github.com/HallexCosta) |
| :---: |
