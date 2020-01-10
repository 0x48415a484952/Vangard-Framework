<?php

namespace Septillion\Classes;

class View
{

    private $_title; 
    private $_stylesheets; 
    private $_javascripts;
    private $_body;

    public function __construct()
    {
        $this->setCss('../Public/assets/main.css');
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function setCss($filePath)
    {
        $this->_stylesheets[] = $filePath;
    }

    public function setJavascript($filePath)
    {
        $this->_javascripts[] = $filePath;
    }

    public function renderView($params = null, $template = null)
    {
        if($template) {
            switch($template) {
                case 'home':
                    include '../Public/views/index.php';
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