<?php

namespace Septillion\App\Controllers;
use App\Models\Post;

// header('Content-Type: application/json');
if(isset($_POST['title'], $_POST['article'], $_POST['uri'])) {
//    $post = new Post($conn);
   $post = new Post();

} else {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'please specify uri parameteres'
        ]
    );
}