<?php
class Database extends PDO {
    protected static $db = FALSE;
    
    public function __construct () { 
        $database = Application::getConf('database');
        
        $dbname = $database->database;
        $host = $database->host;
        $port = $database->port;
        
        parent::__construct (
            "mysql:dbname=$dbname;".
            "host=$host;".
            "port=$port;",
            $database->user,
            $database->password
        );
    }
    
    public static function getDatabase() {
        if (Database::$db === FALSE) {
            Database::$db = new Database();
        }
        
        return Database::$db;
    }
    
    /**
     * 
     * @param $table string
     * @param $params array
     *
     * @return
     */
    public function select ($table, $params = false) {
    	if ($params != false) {
    		$query = "SELECT * FROM $table WHERE $params";
    	} else {
    		$query = "SELECT * FROM $table";
    	}
        $result = $this->query($query, PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public function insert ($table, $fields, $values, $types) {
        foreach($fields as $field) {
            $prepare [] = ':'.$field;    
        }
        
        $_fields = implode(',', $fields);
        $_values = implode(',', $values);
        $_prepare = implode(',', $prepare);
        
        $statement = $this->prepare ("INSERT INTO $table($_fields) VALUES ($_prepare)");
        
        foreach($types as $index => $type){
            $statement->bindParam($prepare[$index], $values[$index], $type);
        }
        
        return $statement->execute();
    }
}
