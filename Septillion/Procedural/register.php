<?php

require_once __DIR__ . '/database.php';
header('Content-Type: application/json');

if(isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']) 
    && !empty(preg_replace('/\s+/', '', $_POST['email']))
    && !empty(preg_replace('/\s+/', '', $_POST['username']))
    ) {
    $email = preg_replace('/\s+/', '', $_POST['email']);
    $username = preg_replace('/\s+/', '', $_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $statement = $conn->prepare("SELECT * FROM users WHERE email=:email OR username=:username");
    $statement->bindParam(':email', $email);
    $statement->bindParam(':username', $username);
    $count = $statement->rowCount();
    if($password == $confirmPassword && $count == 0) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $statement = $conn->prepare("INSERT INTO users (email, username, password) VALUES(:email, :username, :password)");
        $statement->execute([$email, $username, $password]);
    }
    
} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify all parameteres'
        ]
    );
}