<?php
namespace App\Models;

use Framework\Database;


class ProductModel
{

    public static $table = 'products';

    public static function createTable()
    {
        $pdo = Database::getConnection();
        $sql = "CREATE TABLE IF NOT EXISTS " . self::$table . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $pdo->exec($sql);
    }

    public static function dropTable()
    {
        $pdo = Database::getConnection();
        $sql = "DROP TABLE IF EXISTS " . self::$table;
        $pdo->exec($sql);
    }

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

        $stmt = $this->pdo->query("SELECT * FROM " . self::$table . " ORDER BY created_at DESC");
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
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function createProduct($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::$table . " (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }  
    
    
    public function updateProduct($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE " . self::$table . " SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function bulkCreateProducts($products)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::$table . " (name, description) VALUES (:name, :description)");
        foreach ($products as $data) {
            $stmt->execute([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }
        return true;
    }
}
