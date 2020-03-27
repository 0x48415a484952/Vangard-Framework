<?php


namespace Septillion\App\Configs;

use PDO;

class DatabaseConfig
{
    protected const DSN = 'pgsql:dbname=blog;host=127.0.0.1';
    protected const USERNAME = 'hazhir';
    protected const PASSWORD = '';
    protected const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
}