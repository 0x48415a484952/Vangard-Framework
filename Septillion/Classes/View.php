<?php

namespace Septillion\Classes;


class View
{
    public function __construct()
    {
        
    }

    public function renderView($params, $template = null)
    {
        switch($template) {
            case 'home':
                echo 'this is home page';
                echo '<br/>';
                echo 'no shit!';
            break;
            case 'blog':
                echo 'this is blog page';
            break;
            case 'post':
                echo 'this is post page';
            break;
            default:
                echo '404 not found';
        break;
        }
    }
}