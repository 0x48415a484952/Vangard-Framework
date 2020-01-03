<?php

header('Content-Type: application/json');

$cookieName = 'login_status';
if(!isset($_COOKIE[$cookieName])) {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => "Cookie named $cookieName is not set!"
        ]
        
    );
} else {
    echo json_encode(
        [
            'status' => 'success',
            'message' => "Cookie named $cookieName is set!",
            'value' => $_COOKIE[$cookieName]
        ]
    );
}