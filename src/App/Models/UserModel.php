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
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0,
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


    public function findAll() {
        $this->db->query("SELECT * FROM " . self::$table);
        return $this->db->fetchAll(UserEntity::class); 
    }

    public function findOne(int $id) {
        $this->db->query("SELECT * FROM " . self::$table . " WHERE id = :id", ['id' => $id]);
        return $this->db->fetch(UserEntity::class);
    }
    
    public function findOneByEmail(string $email) {
        $this->db->query("SELECT * FROM " . self::$table . " WHERE email = :email", ['email' => $email]);
        return $this->db->fetch(UserEntity::class);
    }

    public function authenticate(string $email, string $password) {
        $user = $this->findOneByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return true;
        }
        return false;
    }

  

    public function create(UserEntity $user) {
        $this->db->query("INSERT INTO " . self::$table . " (first_name, last_name, username, email, password, is_admin) VALUES (:first_name, :last_name, :username, :email, :password, :is_admin)", [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => password_hash($user->password, PASSWORD_DEFAULT),
            'is_admin' => $user->is_admin ?? 0
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function update(int $id, UserEntity $user) {
        $this->db->query("UPDATE " . self::$table . " SET first_name = :first_name, last_name = :last_name, username = :username, email = :email, password = :password, is_admin = :is_admin WHERE id = :id", [
            'id' => $id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => password_hash($user->password, PASSWORD_DEFAULT),
            'is_admin' => $user->is_admin ?? 0
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

}   


    