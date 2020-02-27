<?php 

namespace Septillion\Framework\Request;

use Septillion\Framework\Helper\Helper;
use Septillion\Framework\Request\AssociativeArray;

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

    public static function getInstance() {
        if (!self::$_instance) self::$_instance = new Request();
        return self::$_instance;
    }   

    ///old implementation///
    // private $request;

    // public function __construct()
    // {
    //     $this->request = $_SERVER['REQUEST_URI'];
    // }

    // public function get()
    // {
    //     return $this->request;
    // }

    // public static function request()
    // {
    //     return (new self)->get();
    // } 
}