<?php

namespace Septillion\Framework\Model;

use Septillion\Framework\Model\DatabaseConnection;

class Model
{
    protected $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    public function getConn()
    {
        return $this->conn;
    }
}