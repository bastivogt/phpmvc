<?php
namespace Framework;
use PDO;
use PDOException;


class Database
{
    private  $pdo;
    private $stmt; 

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->connect();
        }
        return self::$instance;
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$GLOBALS['settings']['database']['host']};dbname={$GLOBALS['settings']['database']['name']};charset=utf8;port={$GLOBALS['settings']['database']['port']}",
                $GLOBALS['settings']['database']['user'],
                $GLOBALS['settings']['database']['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
        return $this->pdo;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function disconnect()
    {
        $this->pdo = null;
    }

    public function query($sql, $params = [])
    {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this->stmt;
    }

    public function fetch($entity)
    {
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $entity);
        return $this->stmt->fetch();
    }

    public function fetchAll($entity)
    {
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $entity);
        return $this->stmt->fetchAll();
    }
}