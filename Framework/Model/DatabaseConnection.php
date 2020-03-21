<?php

declare(strict_types=1);

namespace Septillion\Framework\Model;

use PDO;
use PDOException;

class DatabaseConnection
{
    private string $_dsn = 'pgsql:dbname=blog;host=127.0.0.1';
    private string $_user = 'hazhir';
    private string $_pass = '';
    private array $_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    private PDO $_pdo;
    protected static DatabaseConnection $instance;
   
    private function __construct()
    {
        try
        {
            $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_pass, $this->_options);
        }
        catch(PDOException $e)
        {
            echo 'Connection failed: ' . $this->e->getMessage();
        }
    }

    public static function getInstance() : self
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() : PDO
    {
        return $this->_pdo;
    }

    protected function __clone() 
    {
        /* nothing here is needed */
    }
} 