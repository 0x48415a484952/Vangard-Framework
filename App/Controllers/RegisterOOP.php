<?php

namespace Septillion\App\Controllers;
use Septillion\App\Models\User;

// header('Content-Type: application/json');
// require __DIR__ .'/../../vendor/autoload.php';

if(isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
    // $user = new User($conn);
    $user = new User();
    $user->register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password']);
} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify all parameteres'
        ]
    );
}