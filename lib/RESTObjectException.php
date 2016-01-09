<?php 

class RESTObjectException extends Exception {
	const OBJECT_NOT_FOUND = 1111;
	const METHOD_NOT_IMPLEMENTED = 5555;
	const MISSING_PARAMS = 6666;
        
        public function __construct($message = "", $code = 0, \Exception $previous = null) {
            parent::__construct($message, $code, $previous);
        }

	public function printResult() {
		header ('Content-Type: application/json');
                
                print $this->getJSON();
	}
	
	public function getJSON () {
		$result = array(
			'error' => $this->getCode(),
			'message' => $this->getMessage(),
			'object' => basename($this->getFile())
		);
                
                return json_encode($result);
	}
}