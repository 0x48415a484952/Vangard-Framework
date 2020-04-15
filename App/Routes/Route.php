<?php

declare(strict_types=1);

namespace Septillion\App\Routes;

use Septillion\App\Controllers\CategoryController;
use Septillion\Framework\Response\Response;
use Septillion\Framework\Router\Router;
use Septillion\Framework\Request\Request;

require __DIR__ .'/../../vendor/autoload.php';


Router::get('/Septillion/categories/:id{digits}/:someshit2{digits}', 'CategoryController@getCategoryWithId');
//Router::get('/Septillion/categories/:id{alpha}/:someshit2', 'CategoryController@getCategoryWithId');
Router::get('/Septillion/categories', 'CategoryController@getCategories');
//Router::get('/Septillion/categories/:id', 'CategoryController@getCategoryWithId');