<?php

namespace Septillion\Classes;

class Request
{

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_URI'];
    }

    public function get()
    {
        return $this->request;
    }

    public static function request()
    {
        return (new self)->get();
    }

    
}