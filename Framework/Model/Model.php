<?php

declare(strict_types=1);

namespace Septillion\Framework\Model;

use Septillion\Framework\Model\DatabaseConnection;

class Model
{
    public function getConnection() : \PDO
    {
        return DatabaseConnection::getInstance()->getConnection();
    }
}
