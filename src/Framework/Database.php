<?php
namespace Framework;
use PDO;
use PDOException;


class Database
{
    private static $pdo;
    private static $stmt; 

    public static function connect()
    {
        try {
            self::$pdo = new PDO(
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
        return self::$pdo;
    }

    public static function getConnection()
    {
        return self::$pdo;
    }

    public static function disconnect()
    {
        self::$pdo = null;
    }

    public static function query($sql, $params = [])
    {
        self::$stmt = self::$pdo->prepare($sql);
        self::$stmt->execute($params);
        return self::$stmt;
    }

    public static function fetch($entity)
    {
        self::$stmt->setFetchMode(PDO::FETCH_CLASS, $entity);
        return self::$stmt->fetch();
    }

    public static function fetchAll($entity)
    {
        self::$stmt->setFetchMode(PDO::FETCH_CLASS, $entity);
        return self::$stmt->fetchAll();
    }
}