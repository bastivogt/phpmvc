<?php
namespace App\Models;
use PDO;
use PDOException;


class ProductModel
{
    public function __construct()
    {
        
    }



    public function getProducts()
    {
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
        return $stmt->fetchAll();
    }


    public function getProductById($id)
    {
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
            return false;
        }

        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
