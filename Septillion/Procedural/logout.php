<?php
$cookieName = 'login_status';

header('Content-Type: application/json');

if(!isset($_COOKIE[$cookieName])) {
    echo json_encode(
            [
                'status' => 'fail',
                'message' => "Cookie named $cookieName is not set!"
            ]
        );
} else {
    setcookie($cookieName, null, time() - (86400 * 30), '/', null, null, true);
    echo json_encode(
            [
                'status' => 'success',
                'message' => "Cookie named $cookieName has been set!"
            ]
        );
}