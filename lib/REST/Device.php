<?php

/*
 * Copyright (C) 2015 vanlivre
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of Device
 *
 * @author vanlivre
 */
class Device extends RESTObject {
    public function DELETE() {
        throw new RESTMethodNotImplementedException ('Device', 'DELETE');
    }

    public function GET() {
        $result = Array();
        
        $params = $this->getGetParams();
        
        if ($params === FALSE) { 
            throw new RESTMethodNotImplementedException ('Device', 'GET');
        }
        
        if ($params['iddevice']) {
            $where = 'iddevice = ' . $params['iddevice'];
        } elseif ($params['uuid']) {
            $where = 'uuid = ' . $params['uuid'];
        } elseif ($params['serial']) {
            $where = 'serial = ' . $params['serial'];
        }
        
        $db = Database::getDatabase();
        
//        $st = $db->select('device', $where);
//        //@TODO verificação
//        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
//            $iddevice = $row['iddevice'];
//            $result [] = (object) array(
//                'iddevice' => $row['iddevice']
//            );
//        }
        
        $st = $db->select('device_votou_momo', $where);
        
        if ($st) {
            $result [] = (object) array (
                'votou_momo' => ($st->fetch() !== FALSE)
                );
        } else {
            //throw new RESTObjectException ('System error');
        }
        
        $st = $db->select('device_votou_rainha', $where);        
        if ($st !== FALSE) {
            $result [] = (object) array (
                'votou_rainha' => ($st->fetch() !== FALSE)
                );
        } else {
            //throw new RESTObjectException ('System error');
        }
        
        $this->setResult (
            array (
                'status' => 'OK',
                'content' => (object) $result
            )
        );
    }

    public function POST() {
        
        (new SecureKeyAuth())->checkAuth(); //Verificando secure key
        
        $result = Array();
        
        $params = $this->getPostParams();
        
        if ($params === FALSE) { 
            throw new RESTMethodNotImplementedException ('Device', 'POST');
        }
        
        $flag_exists = false;
        
        $db = Database::getDatabase();
        
        if (trim(strtolower($params['platform'])) == 'android') {
            //Verificando serial
            $st_result = $db->query ("SELECT * FROM device WHERE serial = '${params['serial']}'")->fetch();
            
            $flag_exists = $st_result !== false;
        } else {
            $this->setResult(array(
                'status' => 'ERROR',
                'message' => 'Only Android devices are permited'
            ));
            
            return;
        }
        
        if ($flag_exists) {
            $this->setResult(array(
                'status' => 'ERROR',
                'message' => 'Device is registered on database'
            ));
            
            return;
        }
        
        $st = $db->prepare ('INSERT INTO '
                . 'device (uuid, serial, version, platform, model, hash_key)'
                . 'VALUES (:uuid, :serial, :version, :platform, :model, :hash_key)');
        
        $params['hash_key'] = md5 ($params['uuid'].$params['model'].$params['serial']);
        
        foreach ($params as $field => $value) {
            $result[$field] = $value;
            $st->bindValue (':'.$field, $value);
        }
        
        if ($st->execute ()) {
            $this->setResult(array(
                'status' => 'OK',
                'iddevice' => $db->lastInsertId(),
                'hash_key' => $params['hash_key']
            )); 
        } else {
            $this->setResult($db->errorInfo());
        }
        
        
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('Device', 'PUT');
    }
    
    private function getPostParams () {
        $params = array();
        
        if (isset($_POST['uuid'])) {
            $params ['uuid'] = verify_security_string($_POST['uuid']);
        }
        
//        if (isset($_POST['hash_key'])) {
//            $params ['hash_key'] = verify_security_string($_POST['hash_key']);
//        }
        
        if (isset($_POST['serial'])) {
            $params ['serial'] = verify_security_string($_POST['serial']);
        } else {
            $params ['serial'] = '';
        }
        
        if (isset($_POST['version'])) {
            $params ['version'] = verify_security_string($_POST['version']);
        }
        
        if (isset($_POST['platform'])) {
            $params ['platform'] = verify_security_string($_POST['platform']);
        }
        
        if (isset($_POST['model'])) {
            $params ['model'] = verify_security_string($_POST['model']);
        }
        
        return sizeof($params) > 0 ? $params : false ;
    }
    
    private function getGetParams () {
        $params = array();
        
        if (isset($_GET['iddevice'])) {
            $params ['iddevice'] = intval($_GET['iddevice']);
        }
        
        if (isset($_GET['uuid'])) {
            $params ['uuid'] = mysql_real_escape_string($_GET['uuid']);
        }
        
        if (isset($_GET['hash_key'])) {
            $params ['hash_key'] = mysql_real_escape_string($_GET['hash_key']);
        }
        
        if (isset($_GET['serial'])) {
            $params ['serial'] = mysql_real_escape_string($_GET['serial']);
        }
        
        return sizeof($params) > 0 ? $params : false ;
    }
}
