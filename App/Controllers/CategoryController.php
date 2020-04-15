<?php

declare(strict_types=1);

namespace Septillion\App\Controllers;

use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class CategoryController extends Controller
{
    public function getCategories(): void
    {
        $response = new Response('some category');
        $response->send();
    }

    public function getCategoryWithId(Request $request): void
    {
        $response = new Response($request->params->getItem('id'));
        $response->add('<br/>');
        $response->add((string)$request->params->getItem('someshit2'));
        $response->add('<br/>');
        $response->add('<br/>');
        $response->add('<br/>');
        $response->add('<br/>');
        $response->send();
    }
}