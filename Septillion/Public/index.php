<?php

require __DIR__ .'/../../vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];
// var_dump(explode('/', $request));
// var_dump(preg_match_all('/\//', 'hi/bye'));
$routes = [
    '\/blog\/posts\/:id',
    '\/blog\/posts\/:id\/:author',
    '\/blog\/author\/posts\/:id',
    '\/blog\/author\/posts\/:author\/comments',
    // '/blog/posts/:id',
    // '/blog/posts/:id/:author',
    // '/blog/author/posts/:id',
    // '/blog/author/posts/:author/comments',
];
// echo $request;
foreach($routes as $route) {
    $routerParameteres = [];
    $matchedRoute = '';
    $isMatch = true;
    $explodedRoute = explode('\/', $route);
    $explodedRequest = explode('/', $request);
    // print_r($explodedRoute);
    // print_r($explodedRequest);
    if( count($explodedRequest) === count($explodedRoute) ) {
        foreach($explodedRoute as $key => $value) {
            if( !array_key_exists($key, $explodedRequest) ){
                $isMatch = false;
                break;
            }

            if(preg_match('/^:/', $value)) {
                // $explodedRoute[$key] = $explodedRequest[$key];
                $routerParameteres[$value] = $explodedRequest[$key];    
            } else {
                if( $value != $explodedRequest[$key] ){
                    $isMatch = false;
                    break;
                }
            }
            
        }


        if( $isMatch ) {
            $matchedRoute = $route;
            break;
        }
    }
    // if(preg_match_all("/$route/", $request) === '') {
    //     echo $request;
    // }
}
echo $matchedRoute .'<br>';
print_r($routerParameteres);

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