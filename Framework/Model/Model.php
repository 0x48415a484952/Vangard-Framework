<?php

declare(strict_types=1);

namespace Septillion\Framework\Model;

use PDO;

class Model
{
    protected PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    // public function getConn()
    // {
    //     return $this->conn;
    // }
}