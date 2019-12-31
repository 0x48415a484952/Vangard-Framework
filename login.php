<?php

require_once __DIR__ . '/database.php';
header('Content-Type: application/json');

if(isset($_COOKIE['type'])) header('location:index.php');

if(isset($_POST['email'], $_POST['username'], $_POST['password']) 
    && !empty($_POST['password'])
    ) {
    $email = preg_replace('/\s+/', '', $_POST['email']);
    $username = preg_replace('/\s+/', '', $_POST['username']);
    $password = $_POST['password'];
    $statement = $conn->prepare("SELECT * FROM users WHERE email=:email OR username=:username");
    $statement->bindParam(':email', $email);
    $statement->bindParam(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    if(password_verify($password, $row['password'])) {
        setcookie('login_status', sha1($username), time() + (86400 * 30), "/", null, null, true); // 86400 = 1 day
    } else {
        echo json_encode(
            [
                'status' => 'fail',
                'message' => 'your credentials are wrong'
            ]
        );
    }
} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify all parameteres'
        ]
    );
}