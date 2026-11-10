<?php
require __DIR__ . '/../App/Config/Settings.php';
require __DIR__ . '/../Framework/Functions.php';
require __DIR__ . '/../Framework/AutoLoader.php';

use Framework\Database;

use App\Models\ProductModel;
use App\Models\TodoModel;


function main() {
    Database::connect($GLOBALS['settings']['database']);
    
    // Your database synchronization logic here
    ProductModel::createTable();
    TodoModel::createTable();
    //ProductModel::dropTable();
    //TodoModel::dropTable();
}

main();
echo "Database synchronized successfully.\n";