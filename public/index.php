<?php

use Framework\DIContainer;
use Framework\Database;


class App {

    public static $greeting = "Hello from App";

    public static $currentUser = null;
    public static $container;
    
    public static function run() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        require __DIR__ . '/../src/Framework/Bootstrap.php';


        self::$container = require __DIR__ . '/../src/App/Config/Container.php';





        $db = self::$container->get(Database::class);
        $db->connect();

        require '../src/App/Config/Routes.php';
    }
}

$app = new App();
$app->run();











// $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $method = $_SERVER['REQUEST_METHOD'];

// require '../src/Framework/AutoLoader.php';
// require '../src/Framework/Functions.php';
// require '../src/App/Config/Settings.php';


// use Framework\Database;

// Database::connect();

// require '../src/App/Config/Routes.php';









