<?php
require_once __DIR__ . '/../App/Config/Settings.php';
require_once __DIR__ . '/../Framework/AutoLoader.php';
use Framework\Database;
use App\Models\ProductModel;

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
}

main();
echo "Database seeded successfully.\n";