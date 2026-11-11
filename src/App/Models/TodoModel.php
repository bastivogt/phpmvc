<?php
namespace App\Models;

use Framework\Database;
use App\Entities\TodoEntity;
use PDO;

class TodoModel
{
    public static $table = 'todos';

    public static function createTable()
    {
        $pdo = Database::getConnection();
        $sql = "CREATE TABLE IF NOT EXISTS " . self::$table . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            done BOOLEAN DEFAULT FALSE,
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


    public function findAll()
    {
        Database::query("SELECT * FROM " . self::$table . " ORDER BY created_at DESC");
        return Database::fetchAll(TodoEntity::class);

    }

    public function findOne($id)
    {
        Database::query("SELECT * FROM " . self::$table . " WHERE id = :id", ['id' => $id]);
        return Database::fetch(TodoEntity::class);  
    }
    
    public function create(TodoEntity $todo)
    {
        Database::query("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)", [
            'title' => $todo->title,
            'description' => $todo->description,
            'done' => $todo->done ? 1 : 0 
        ]);
    }

    public function update($id, TodoEntity $todo)
    {
        Database::query("UPDATE " . self::$table . " SET title = :title, description = :description, done = :done WHERE id = :id", [
            'id' => $id,
            'title' => $todo->title,
            'description' => $todo->description,
            'done' => $todo->done ? 1 : 0
        ]);
    }

    public function delete($id)
    {
        Database::query("DELETE FROM " . self::$table . " WHERE id = :id", ['id' => $id]);
    }


    // check if working correctly
    public function bulkCreate($todos)
    {
        foreach ($todos as $todo) {
            Database::query("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)", [
                'title' => $todo->title,
                'description' => $todo->description,
                'done' => $todo->done ? 1 : 0
            ]);
        }
    }
}