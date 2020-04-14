<?php

declare(strict_types=1);

namespace Septillion\Framework\Model;

use PDO;
use PDOException;
use Septillion\App\Configs\DatabaseConfig;

class DatabaseConnection extends DatabaseConfig
{
    private PDO $_pdo;
    protected static DatabaseConnection $instance;
   
    private function __construct()
    {
        try
        {
            $this->_pdo = new PDO(
                DatabaseConfig::DSN,
                DatabaseConfig::USERNAME,
                DatabaseConfig::PASSWORD,
                DatabaseConfig::OPTIONS
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
        return $this->_pdo;
    }

    protected function __clone() 
    {
        /* nothing here is needed */
    }
}
