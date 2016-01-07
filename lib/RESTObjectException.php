<?php 

class RESTObjectException extends Exception {
	const OBJECT_NOT_FOUND = 1111;
	const METHOD_NOT_IMPLEMENTED = 5555;
	const MISSING_PARAMS = 6666;

	public function printResult() {
		header ('application/json');
                
                print $this->getJSON();
	}
	
	public function getJSON () {
		$result = array(
			'error' => $this->getCode(),
			'message' => $this->getMessage(),
			'object' => $this->getFile()
		);
	}
}