<?php

require_once __DIR__ . '/database.php';
header('Content-Type: application/json');

$statement = $conn->prepare('SELECT * FROM posts');
$statement->execute();
$row = $statement->fetch();
$statement = null;
echo json_encode($row);