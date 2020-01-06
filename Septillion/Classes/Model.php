<?php

namespace Septillion\Classes;
use Septillion\Classes\DatabaseConnection;

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