<?php
namespace App\Models;

use Framework\Database;

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
        $stmt = $this->pdo->query("SELECT * FROM " . self::$table . " ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function findOne($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)");
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'done' => $data['done']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE " . self::$table . " SET title = :title, description = :description, done = :done WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'done' => isset($data['done']) ? $data['done'] : false
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function bulkCreate($todos)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::$table . " (title, description, done) VALUES (:title, :description, :done)");
        foreach ($todos as $todo) {
            $stmt->execute([
                'title' => $todo['title'],
                'description' => $todo['description'],
                'done' => isset($todo['done']) ? $todo['done'] : false  
            ]);
        }
    }
}