<?php

namespace App\Models;

use Framework\Database;

use App\Entities\UserEntity;
use Framework\BaseModel;

class UserModel extends BaseModel {
    // Model methods for UserEntity

    private static $table = 'users';

    public static function createTable() {
        $db = Database::getInstance();
        $pdo = $db->connect();
        $query = "CREATE TABLE IF NOT EXISTS " . self::$table . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->exec($query);
    }

    public static function dropTable() {
        $db = Database::getInstance();
        
        $pdo = $db->connect();
        
        $query = "DROP TABLE IF EXISTS " . self::$table;
        $pdo->exec($query);
    }   

    public function __construct(Database $db) {
        parent::__construct($db);
    }
}