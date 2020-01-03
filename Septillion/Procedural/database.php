<?php
namespace App\Septillion\Classes;
use PDO;
use PDOException;

const DATABASE_USERNAME = 'hazhir';
const DATABASE_PASSWORD = '';
const DSN = 'pgsql:host=localhost;dbname=blog;';
const OPTIONS = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO(DSN, DATABASE_USERNAME, DATABASE_PASSWORD, OPTIONS);
    // echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
