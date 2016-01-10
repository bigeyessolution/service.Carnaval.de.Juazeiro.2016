<?php

/*
 * Copyright (C) 2016 vanlivre
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
 * Description of SecureDeviceHash
 *
 * @author vanlivre
 */
class SecureDeviceHash extends AbstractAuth {
    public function checkAuth() {
        $params = $this->getPostParams();
        
        $db = Database::getDatabase();
        
        if ($db->select(
                'device', 
                "iddevice = ${params['iddevice']} and hash_key = '${params['hash_key']}'"
            )->fetch()) {
            return TRUE;
        } else {
           throw new RESTObjectException ('This device has not permission');
        }
    }
    
    private function getPostParams () {
        $params = array();
        
        if (isset($_POST['iddevice'])) {
            $params ['iddevice'] = intval($_POST['iddevice']);
        }
        
        if (isset($_POST['hash_key'])) {
            $params ['hash_key'] = verify_security_string($_POST['hash_key']);
        }
                
        if (sizeof($params) != 2) {
            throw new RESTObjectException ('Missed params');
        }
        
        return $params;
    }
}
