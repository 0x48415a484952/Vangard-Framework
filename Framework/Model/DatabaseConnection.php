<?php

declare(strict_types=1);

namespace Septillion\Framework\Model;

use PDO;
use PDOException;

class DatabaseConnection
{
    private PDO $pdo;
    private static $instance;

    private function __construct()
    {
        try
        {
            
            $databaseDsn = getenv('DATABASE_DSN');
            $databaseUsername = getenv('DATABASE_USERNAME');
            $databasePassword = getenv('DATABASE_PASSWORD');

            $this->pdo = new PDO(
                $databaseDsn,
                $databaseUsername,
                $databasePassword,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        }
        catch(PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
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
        return $this->pdo;
    }

    protected function __clone() 
    {
        /* nothing here is needed */
    }
}
