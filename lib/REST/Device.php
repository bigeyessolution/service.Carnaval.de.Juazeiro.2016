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
        throw new RESTMethodNotImplemented ('Device', 'DELETE');
    }

    public function GET() {
        $db = Database::getDatabase();
        
        $result = Array();
        
        $params = $this->getParams();
        
        if ($params === FALSE) {
            throw new RESTMethodNotImplemented ('Device', 'GET');
        }
        
        if ($params['iddevice']) {
            $where = 'iddevice = ' . $params['iddevice'];
        } elseif ($params['uuid']) {
            $where = 'uuid = ' . $params['uuid'];
        }
        
        $st = $db->select('device', $where);
        //@TODO verificação
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) { 
            $result [] = (object) $row;
        }
        //verificar se já votou no rei momo
         //   $result_aux = array();
            
        //            = $db->select('device', 'iddevice = ' . $params['iddevice']);
        //verificar se já votou na rainha
        
        
        
        
        
        $this->setResult (
            array (
                'status' => 'OK',
                'content' => (object) $result
            )
        );
    }

    public function POST() {
        throw new RESTMethodNotImplemented ('Device', 'POST');
    }

    public function PUT() {
        throw new RESTMethodNotImplemented ('Device', 'PUT');
    }
    
    private function getParams () {
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
        
        return sizeof($params) > 0 ? $params : false ;
    }
}
