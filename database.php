<?php

$host = 'localhost';
$databaseName = 'blog';
$databaseUsername = 'hazhir';
$databasePassword = '';
$dsn = "pgsql:host=$host;dbname=$databaseName;";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $conn = new PDO($dsn, $databaseUsername, $databasePassword, $options);
    // echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}