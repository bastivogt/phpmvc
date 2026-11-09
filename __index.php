<?php 

require_once 'helper.php';

$dsn = 'mysql:host=localhost;dbname=product_db;charset=utf8;port=3308';
$username = 'root';
$password = 'Function7';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}


$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll();
# d($products);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo esc($product['name']) . ' - ' . esc($product['description']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>