<?php 

class Application {
    public static function startEnvironment() {
        
    }
    
    /**
     * Return an object with the content of the file named "$conf_file".json
     * 
     * @param string $conf_file
     * @return boolean
     */
    public static function getConf ($conf_file) {
        $filename = \CONFDIR.$conf_file.'.json';
        
        if ($conf_file and file_exists($filename)) {
            $conf_object = json_decode(file_get_contents($filename)) 
                    or die('SYSTEM ERR: File not exists.');

            return $conf_object;
        }

        return false;    
    }
    
    /**
     * @todo verificar em banco de dados as demais autenticações se houverem.
     * @return type
     */
    public static function checkPlainAuth () {
        return isset($_GET['secret']) and
            $_GET['secret'] == self::getConf('security')->secret;
    }
    
    public static function checkDeviceAuth () {
        return false;
    }
}