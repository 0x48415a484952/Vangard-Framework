<?php

declare(strict_types=1);

namespace Septillion\App\Controllers;

use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Response\Response;

class CategoryController extends Controller
{
    public function getCategories(): void
    {
        $some = new Response('some category');
        $some->send();
    }
}