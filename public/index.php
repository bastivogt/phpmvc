<?php

use Framework\DIContainer;
use Framework\Database;
use Framework\Session;
use App\Services\AuthService;




class App {

    public static $greeting = "Hello from App";

    //public static $currentUserID = null;
    public static $container;
    public static $user;
    
    public static function run() {
        
        // $_SESSION['test'] = 'value';
        
        

        

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        require __DIR__ . '/../src/Framework/Bootstrap.php';

        Session::start();
        //Session::set('test', 'Hallo Test!');

        self::$container = require __DIR__ . '/../src/App/Config/Container.php';


        



        $db = self::$container->get(Database::class);
        $db->connect();

        $authService = self::$container->get(AuthService::class);   
        // d($authService->isAuthenticated());

        if ($authService->isAuthenticated()) {
            self::$user = $authService->getCurrentUser();
        }
        //d(self::$user);

        

        require '../src/App/Config/Routes.php';
    }
}
App::run();
//$app = new App();
//$app->run();











// $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $method = $_SERVER['REQUEST_METHOD'];

// require '../src/Framework/AutoLoader.php';
// require '../src/Framework/Functions.php';
// require '../src/App/Config/Settings.php';


// use Framework\Database;

// Database::connect();

// require '../src/App/Config/Routes.php';









