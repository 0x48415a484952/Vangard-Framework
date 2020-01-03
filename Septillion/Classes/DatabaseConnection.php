<?php

namespace Septillion\Classes;
use PDO;
use PDOException;

class DatabaseConnection
{
    private $_dsn = 'pgsql:dbname=blog;host=127.0.0.1';
    private $_user = 'hazhir';
    private $_pass = '';
    private $_options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private $_pdo;
    protected static $instance;
   
    // protected function __construct()
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

    public static function getInstance()
    {
        // if(!isset(self::$instance)) {
        if(!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->_pdo;
    }

    protected function __clone() 
    {
        /* nothing here is needed */
    }
} 