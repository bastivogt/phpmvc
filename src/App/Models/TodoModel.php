<?php
namespace App\Models;

use Framework\Database;
use App\Entities\TodoEntity;
use Framework\BaseModel;
use PDO;
use App;

class TodoModel extends BaseModel
{
    public static $table = 'todos';

    public static function createTable()
    {
        $db = Database::getInstance();  
        $db->connect();
        $pdo = $db->getConnection();
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
        $db = Database::getInstance();  
        $db->connect();
        $pdo = $db->getConnection();
        $sql = "DROP TABLE IF EXISTS " . self::$table;
        $pdo->exec($sql);
    }

    public function __construct(Database $db)
    {
        parent::__construct($db);
    }


    public function findAll()
    {
        $this->db->query("SELECT * FROM " . self::$table . " ORDER BY created_at DESC");
        return $this->db->fetchAll(TodoEntity::class);

    }

    public function findOne($id)
    {
        $this->db->query("SELECT * FROM " . self::$table . " WHERE id = :id", ['id' => $id]);
        return $this->db->fetch(TodoEntity::class);  
    }
    
    public function create(TodoEntity $todo)
    {
        $this->db->query("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)", [
            'title' => $todo->title,
            'description' => $todo->description,
            'done' => $todo->done ? 1 : 0 
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function update($id, TodoEntity $todo)
    {
        $this->db->query("UPDATE " . self::$table . " SET title = :title, description = :description, done = :done WHERE id = :id", [
            'id' => $id,
            'title' => $todo->title,
            'description' => $todo->description,
            'done' => $todo->done ? 1 : 0
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM " . self::$table . " WHERE id = :id", ['id' => $id]);
        return true;
    }


    // check if working correctly
    public function bulkCreate($todos)
    {
        foreach ($todos as $todo) {
            $this->db->query("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)", [
                'title' => $todo->title,
                'description' => $todo->description,
                'done' => $todo->done ? 1 : 0
            ]);
        }
    }
}