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
 * Description of SecureKeyAuth
 *
 * @author vanlivre
 */
class SecureKeyAuth extends AbstractAuth {
    private $secrets;
    private $user_key = FALSE;
    
    public function __construct() {
        $security = Application::getConf('security');
        
        if ($security === FALSE) {
            throw new RESTObjectException ('System error');
        }
        
        $this->secrets = $security->secrets;
    }
    
    public function checkAuth() {
        if(!isset($_GET['securekey'])) {
            throw new RESTObjectException ('It is necessary a secure key to call this method');
        }
        
        $this->user_key = $_GET['securekey'];
        
        if (array_search($this->user_key, $this->secrets) === FALSE) {
            throw new RESTObjectException ('Invalid secure key');
        }        
    }
}
