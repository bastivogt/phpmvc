<?php
use App\Controllers\PageController;
use App\Controllers\ProductController;
use App\Controllers\TodoController;
use App\Controllers\AuthController;
use Framework\Router;

$router = new Router();





$router->get('#^/$#', [PageController::class, 'index']);
$router->get('#^/products$#', [ProductController::class, 'index']);
$router->get('#^/products/(?<id>\d+)$#', [ProductController::class, 'show']);
$router->get('#^/products/create$#', [ProductController::class, 'create']);
$router->post('#^/products$#', [ProductController::class, 'store']);
$router->get('#^/products/(?<id>\d+)/edit$#', [ProductController::class, 'edit']);
$router->post('#^/products/(?<id>\d+)$#', [ProductController::class, 'update']);
$router->get('#^/products/(?<id>\d+)/delete$#', [ProductController::class, 'delete']);
$router->post('#^/products/(?<id>\d+)/delete$#', [ProductController::class, 'destroy']);

// Todo routes
$router->get('#^/todos$#', [TodoController::class, 'index']);
$router->get('#^/todos/(?<id>\d+)$#', [TodoController::class, 'show']);
$router->get('#^/todos/create$#', [TodoController::class, 'create']);
$router->post('#^/todos$#', [TodoController::class, 'store']);
$router->get('#^/todos/(?<id>\d+)/edit$#', [TodoController::class, 'edit']);
$router->post('#^/todos/(?<id>\d+)$#', [TodoController::class, 'update']);
$router->get('#^/todos/(?<id>\d+)/delete$#', [TodoController::class, 'delete']);
$router->post('#^/todos/(?<id>\d+)/delete$#', [TodoController::class, 'destroy']);


$router->get('#^/auth/login$#', [AuthController::class, 'loginForm']);
$router->post('#^/auth/login$#', [AuthController::class, 'login']);
$router->post('#^/auth/logout$#', [AuthController::class, 'logout']);


$router->get('#^.*$#', [PageController::class, 'notFound']);



echo $router->dispatch($method, $path);