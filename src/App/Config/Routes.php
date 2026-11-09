<?php
use App\Controllers\PageController;
use App\Controllers\ProductController;
use Framework\Router;

$router = new Router();




$router->get('#^/$#', [PageController::class, 'index']);
$router->get('#^/products$#', [ProductController::class, 'index']);
$router->get('#^/products/(?<id>\d+)$#', [ProductController::class, 'show']);
$router->get('#^/products/create$#', [ProductController::class, 'create']);
$router->post('#^/products$#', [ProductController::class, 'store']);


$router->get('#^.*$#', [PageController::class, 'notFound']);



$router->dispatch($method, $path);