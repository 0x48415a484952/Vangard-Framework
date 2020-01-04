<?php

namespace Septillion\Classes;


class View
{
    public function __construct()
    {
        
    }

    public function renderView($params, $template = null)
    {
        if($template) {
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
                case 'login':
                    echo 'this is login page';
                break;
                default:
                    echo 'the template that has been set is not written yet, 
                        please write the template first or change the tenplate name';
            break;
            }
        } else {
            foreach($params as $param) {
                if(is_array($param)) {
                    foreach($param as $item) {
                        echo $item;
                    }
                } else {
                    echo $param;
                }
            }
        }
        

    }
}