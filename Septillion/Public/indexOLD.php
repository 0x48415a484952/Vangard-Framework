<?php

use Septillion\Classes\Request;
use Septillion\Classes\Router;

require __DIR__ .'/../../vendor/autoload.php';

// $request = Request::request()->get();
echo Router::get('/blog/:id', null);
// $request = $_SERVER['REQUEST_URI'];

//from here is main one
// $request = Request::request()->get();
// $routes = [
//     '/blog/posts/:id',
//     '/blog/posts/:id/:author',
//     '/blog/author/posts/:id',
//     '/blog/author/posts/:author/comments',
// ];

// foreach($routes as $route) {
//     $routerParameteres = [];
//     $matchedRoute = '';
//     $isMatch = true;
//     $explodedRoute = explode('/', $route);
//     $explodedRequest = explode('/', $request);
//     if( count($explodedRequest) == count($explodedRoute) ) {
//         foreach($explodedRoute as $key => $value) {
//             if( !array_key_exists($key, $explodedRequest) ){
//                 $isMatch = false;
//                 break;
//             }

//             if(preg_match('/^:/', $value)) {
//                 $trimedValue = substr($value, 1);
//                 $routerParameteres[$trimedValue] = $explodedRequest[$key];    
//             } else {
//                 if( $value != $explodedRequest[$key] ){
//                     $isMatch = false;
//                     break;
//                 }
//             }
//         }
//         if( $isMatch ) {
//             $matchedRoute = $route;
//             break;
//         }
//     }
// }
// echo $matchedRoute .'<br>';
// print_r($routerParameteres);
//end of main


// switch ($request) {
//     case '/blog/posts/:id' :
//         require __DIR__ . '/../Views/index.php';
//         break;
//     case '/blog/Septillion/' :
//         require __DIR__ . '/../Views/index.php';
//         break;
//     case '/blog/Septillion/home' :
//         require __DIR__ . '/../Views/index.php';
//         break;
//     case '/blog/Septillion/about' :
//         require __DIR__ . '/../Views/about.php';
//         break;
//     case '/blog/Septillion/post' :
//         require __DIR__ . '/../Views/post.php';
//         break;
//     case '/blog/Septillion/blog' :
//         require __DIR__ . '/../Views/blog.php';
//         break;
//     case '/blog/Septillion/login' :
//         require __DIR__ . '/../Views/login.php';
//         break;
//     default:
//         http_response_code(404);
//         require __DIR__ . '/../Views/404.php';
//         break;
// }

// Router::get('/blog/:id', function(POST ){

// })