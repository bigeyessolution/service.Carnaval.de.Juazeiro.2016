<?php 

abstract class RESTObject {
    protected static $object = false;
    
    private $result = false;
    
    abstract public function GET();
    
    abstract public function POST();
    
    abstract public function PUT ();
    
    abstract public function DELETE();
    
    protected function setResult ($result) {
        $this->result = $result;
    }
    
    public function getJSON () {
        return json_encode (
            $this->result, 
            JSON_NUMERIC_CHECK | 
            JSON_PRESERVE_ZERO_FRACTION | 
            JSON_ERROR_NONE
            );
    }
    
    public function printJSON () {
        header ('Content-Type: application/json');
        
        print $this->getJSON();
    }
    
    public static function objectFactory () {
        if (RESTObject::$object === false) {
            $object_name = Router::getObjectName ();
            
            if (file_exists(__DIR__."/REST/$object_name.php")) {
                require_once __DIR__."/REST/$object_name.php";
                
                RESTObject::$object = new $object_name ();
            } else {
                //Exception
            }
        }
        
        return RESTObject::$object;
    }
}
