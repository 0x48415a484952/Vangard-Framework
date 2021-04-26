<?php

declare(strict_types=1);

namespace Septillion\App\Controllers;

use Septillion\App\Models\User;
use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $user = new User();
        // $response = new Response($user->getConnection());
        
        // $response->send();
        // dd($user->getConnection());
        // $user->getConnection()->exec('insert into users (username, email) values (\'hazhir\', \'hazhir1811@gmail.com\')');
        // $user->getConnection()->commit();
        $content = $user->getConnection()->query('select * from users')->rowCount();

        $response = new Response($content);
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