<?php
namespace Framework;

use Framework\Database;

class BaseModel
{
    protected $db;
    protected $pdo;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->pdo = $db->getConnection();
    }
}