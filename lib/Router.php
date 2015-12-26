<?php 

class Router {
    const GET = -2365;
    const POST = -2366;
    const PUT = -2367;
    const DELETE = -2368;
    
    private static $object = false;
    private static $objectName = false;
    private static $method = false;
    
    public function init () {
    	
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        
        $uri = explode('/', $uri[0]);
        
        if (count($uri) < 3 or $uri[2] == '') {
        	Router::$objectName = 'Index';
        } else {
        	Router::$objectName = $uri[2];
        }
        
        Router::$object = RESTObject::objectFactory ();
        
        switch($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                Router::$method = Router::POST;
                break;
            case 'PUT':
                Router::$method = Router::PUT;
                break;
            case 'DELETE':
                Router::$method = Router::DELETE;
                break;
            default:
                Router::$method = Router::GET;
        }
    }
    
    /**
     *
     * @return RESTObject
     */
    public static function getObjectName () {
        return Router::$objectName;
    }
    
    public static function getObject () {
        return Router::$object;
    }
    
    public static function getMethod () {
        return Router::$method;
    }
    
    public static function executeMethod () {
        $obj = Router::getObject();
        
        switch(self::getmethod()) {
            case Router::GET:
                $obj->GET();
                break;
            case Router::POST:
                $obj->POST();
                break;
            case Router::PUT:
                $obj->PUT();
                break;
            case Router::DELETE:
                $obj->DELETE();
                break;
        }
    }
}
