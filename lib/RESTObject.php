<?php 

abstract class RESTObject {
    const JSON_CONTENT_TYPE = 'application/json';
    const HTML_CONTENT_TYPE = 'text/html';
    const TEXT_CONTENT_TYPE = 'text/plain';

    protected static $object = false;
    
    private $content_type = 'application/json';
    
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
    
    protected function setContentType ($content_type) {
        $this->content_type = $content_type;
    }


    public function printResult () {
        header('Content-Type: ' . $this->content_type);
        
        switch ($this->content_type) {
            case self::JSON_CONTENT_TYPE:
                print $this->getJSON();
                break;
            default :
                print $this->result;
        }
        
        flush();
    }
    
    public function printJSON () {        
        print $this->getJSON();
    }
    
    public static function objectFactory () {
        if (RESTObject::$object === false) {
            $object_name = Router::getObjectName ();
            
            if (file_exists(RESTDIR."$object_name.php")) {
                require_once RESTDIR."$object_name.php";
                
                //Verificar parâmetros
                
                RESTObject::$object = new $object_name ();
            } else {
                //Exception
            }
        }
        
        return RESTObject::$object;
    }
}
