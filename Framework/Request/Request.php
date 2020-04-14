<?php 

declare(strict_types=1);

namespace Septillion\Framework\Request;

use Septillion\Framework\Helper\AssociativeArray;
use Septillion\Framework\Middleware\Middleware;

class Request {
    //commented out just in time
//    private static $_middleware;
    private static $_instance;
    public string $uri;
    public array $uriParts = [];
    public AssociativeArray $params;
    public AssociativeArray $query;
    public AssociativeArray $body;

    private function __construct()
    {
        $this->uri = removeTrailingSlash($_SERVER['REQUEST_URI']);
        $this->uriParts = explode('/', $this->uri);
        $this->query    = new AssociativeArray();
        $this->body     = new AssociativeArray();
        $this->params   = new AssociativeArray();
    }

    public static function setPostBodyParams() : void
    {
        $body = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
            foreach($_POST as $key => $value) {
                $body[$key] = htmlspecialchars($value);
            }
            self::getInstance()->body->set($body);
        }
    }

    public static function getInstance() : self
    {
        if (!self::$_instance) {
            self::$_instance = new Request();

            //commented out just in time
//            self::$_middleware = new Middleware();
//            self::$_middleware->run(self::$_instance);
        }

        //commented out just in time
//        self::$_middleware->run(self::$_instance);

        return self::$_instance;
    }
}
