<?php

namespace Septillion\Classes;

class View
{
    private $params = [];

    public function __construct()
    {
        
    }

    public function setParams($params)
    {
        foreach($params as $key => $value) {
            $this->param[$key] = $value;
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function renderView()
    {
        echo 'this is a simple view';
    }
}