<?php
require 'src/Framework/AutoLoader.php';
require 'src/Framework/Functions.php';

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use Framework\Router;


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require 'src/App/Routes.php';


// if ($path === '/') {
//     $path = '/home/index';
// }











// $router = new Router();
// $router->get('#^/$#', [HomeController::class, 'index']);
// $router->get('#^/home/index$#', [HomeController::class, 'index']);
// $router->get('#^/products$#', [ProductController::class, 'index']);
// $router->get('#^/products/(?<id>\d+)$#', [ProductController::class, 'show']);

// $router->dispatch($method, $path);
