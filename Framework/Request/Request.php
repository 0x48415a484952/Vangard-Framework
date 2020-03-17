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

    public static function setPostBodyParams()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            foreach($_POST as $key => $value) {
                $body[$key] = htmlspecialchars($value);
            }
            self::getInstance()->body->set($body);
            // $request->body->set($body);
        }
    }

    public static function getInstance() {
        if (!self::$_instance) self::$_instance = new Request();
        return self::$_instance;
    }
}
