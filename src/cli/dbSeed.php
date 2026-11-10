<?php
require_once __DIR__ . '/../App/Config/Settings.php';
require_once __DIR__ . '/../Framework/AutoLoader.php';
use Framework\Database;
use App\Models\ProductModel;
use App\Models\TodoModel;

function main() {
    Database::connect($GLOBALS['settings']['database']);
    // Your database seeding logic here
    $productModel = new ProductModel();
    $products = [
        ['name' => 'Product 1', 'description' => 'Description 1'],
        ['name' => 'Product 2', 'description' => 'Description 2'],
        ['name' => 'Product 3', 'description' => 'Description 3'],
    ];
    $productModel->bulkCreateProducts($products);

    $todoModel = new TodoModel();
    $todos = [
        ['title' => 'Todo 1', 'description' => 'Description 1', 'done' => false],
        ['title' => 'Todo 2', 'description' => 'Description 2', 'done' => true],
        ['title' => 'Todo 3', 'description' => 'Description 3', 'done' => false],
    ];
    $todoModel->bulkCreate($todos); 
}

main();
echo "Database seeded successfully.\n";