<?php 

namespace Septillion\Classes;
use Septillion\Classes\Helper;
use Septillion\Classes\AssociativeArray;

class Request {
    private static $_instance;
    public $uri;
    public $uriParts = [];
    public $params;
    public $query;
    public $body;

    private function __construct() {
        $this->uri = Helper::removeTrailingSlash($_SERVER['REQUEST_URI']);
        $this->uriParts = explode('/', $this->uri);

        $this->query    = new AssociativeArray();
        $this->body     = new AssociativeArray();
        $this->params   = new AssociativeArray();
    }

    public static function getInstance(){
        if( !self::$_instance ) self::$_instance = new Request();
        return self::$_instance;
    }    
}