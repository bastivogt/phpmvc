<?php

// FrontController

require_once "helper.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

d($path);

if ($path === '/') {
    $path = '/home/index';
}

$segments = explode('/', trim($path, '/'));
d($segments);





$action = $segments[1] ?? "index";
$controllerName = $segments[0];
$params = array_slice($segments, 2);
$controllerName = ucfirst($controllerName);

d($params);



$file = "src/controllers/{$controllerName}.php";
if (!file_exists($file)) {
    notFound();
}

require_once "src/controllers/{$controllerName}.php";
// dd($controllerName);


if (!class_exists($controllerName)) {
    notFound();
}
if (!method_exists($controllerName, $action)) {
    notFound();
}

$controller = new $controllerName();

$controller->$action($params);

