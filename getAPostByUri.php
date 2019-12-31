<?php

require_once __DIR__ . '/database.php';
header('Content-Type: application/json');

if(isset($_GET['uri'])) {
    $param = $_GET['uri'];
    $statement = $conn->prepare("SELECT * FROM posts WHERE uri=:param");
    $statement->bindParam(':param', $param);
    $statement->execute();
    $row = $statement->fetch();
    echo json_encode($row);
} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify uri parametere'
        ]
    );
}