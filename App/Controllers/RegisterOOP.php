<?php

namespace Septillion\App\Controllers;

use Septillion\App\Models\User;

header('Content-Type: application/json');

if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
    $user = new User();
    $user->register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password']);
} else {
    echo json_encode([
        'status' => 'fail',
        'message' => 'please specify all parameteres'
    ]);
}