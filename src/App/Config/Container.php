<?php
namespace App\Config;

use Framework\DIContainer;
use Framework\Database;
use App\Models\TodoModel;
use App\Controllers\TodoController;
use App\Models\UserModel;
use App\Controllers\UserController;

$container = new DIContainer(); 


// DB
$container->set(Database::class, function($container) {
    return new Database();
});

// Todos
$container->set(TodoModel::class, function($container) {
    return new TodoModel($container->get(Database::class));
});
$container->set(TodoController::class, function($container) {
    return new TodoController($container->get(TodoModel::class));
});


// Users
$container->set(UserModel::class, function($container) {
    return new UserModel($container->get(Database::class));
});
$container->set(UserController::class, function($container) {
    return new UserController($container->get(UserModel::class));
});


return $container;