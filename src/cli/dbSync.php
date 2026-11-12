<?php
// require __DIR__ . '/../App/Config/Settings.php';
// require __DIR__ . '/../Framework/Functions.php';
// require __DIR__ . '/../Framework/AutoLoader.php';

require __DIR__ . '/../Framework/Bootstrap.php';

use Framework\Database;

use App\Models\ProductModel;
use App\Models\TodoModel;
use App\Models\UserModel;










function main() {


    //Database::connect($GLOBALS['settings']['database']);
    // $db = Database::getInstance();  
    // $db->connect();
    
    
    // Your database synchronization logic here
    //ProductModel::createTable();
    TodoModel::createTable();
    UserModel::createTable();
    //UserModel::dropTable();
    //ProductModel::dropTable();
    //TodoModel::dropTable();
}

main();
echo "Database synchronized successfully.\n";