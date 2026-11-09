<?php
require '../src/Framework/AutoLoader.php';
require '../src/Framework/Functions.php';



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require '../src/App/Routes.php';


