<?php

require_once __DIR__ . '/database.php';
header('Content-Type: application/json');

if(isset($_POST['title'], $_POST['article'], $_POST['uri']) 
    && !empty(preg_replace('/\s+/', '', $_POST['uri']))
    ) {
    $title = $_POST['title'];
    $article = $_POST['article'];
    $uri = preg_replace('/\s+/', '', $_POST['uri']);
    $statement = $conn->prepare("INSERT INTO posts (title, article, uri) VALUES(:title, :article, :uri)");
    $statement->execute([$title, $article, $uri]);
} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify uri parameteres'
        ]
    );
}