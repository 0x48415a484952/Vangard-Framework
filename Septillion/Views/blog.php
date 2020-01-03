<?php
use Septillion\Classes\Post;
use Septillion\Classes\View;
$post = new Post();
$posts = $post->getAllPosts();
$view = new View();
$view->renderView($posts, 'blog');