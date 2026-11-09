<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require '../src/Framework/AutoLoader.php';
require '../src/Framework/Functions.php';
require '../src/App/Config/Settings.php';


use Framework\Database;

Database::connect();

require '../src/App/Config/Routes.php';









