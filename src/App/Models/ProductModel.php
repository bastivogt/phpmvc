<?php
namespace App\Models;
use PDO;
use PDOException;
use Framework\Database;


class ProductModel
{

    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }



    public function getProducts()
    {
        
        // $dsn = "mysql:host={$GLOBALS['settings']['database']['host']};dbname={$GLOBALS['settings']['database']['name']};charset=utf8;port={$GLOBALS['settings']['database']['port']}";
        // $username = $GLOBALS['settings']['database']['user'];
        // $password = $GLOBALS['settings']['database']['password'];

        // try {
        //     $pdo = new PDO($dsn, $username, $password, [
        //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        //     ]);
        // } catch (PDOException $e) {
        //     echo 'Connection failed: ' . $e->getMessage();
        //     exit;
        // }

        $stmt = $this->pdo->query("SELECT * FROM product");
        return $stmt->fetchAll();
    }


    public function getProductById($id)
    {
        // $dsn = "mysql:host={$GLOBALS['settings']['database']['host']};dbname={$GLOBALS['settings']['database']['name']};charset=utf8;port={$GLOBALS['settings']['database']['port']}";
        // $username = $GLOBALS['settings']['database']['user'];
        // $password = $GLOBALS['settings']['database']['password'];

        // try {
        //     $pdo = new PDO($dsn, $username, $password, [
        //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        //     ]);
        // } catch (PDOException $e) {
        //     echo 'Connection failed: ' . $e->getMessage();
        //     return false;
        // }
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function createProduct($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO product (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }  
    
    
    public function updateProduct($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE product SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM product WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
