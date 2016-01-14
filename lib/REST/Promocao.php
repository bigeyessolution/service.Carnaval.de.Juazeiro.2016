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
 * Description of VencedoresDaPromocao
 *
 * @author vanlivre
 */
class Promocao extends RESTObject {
    public function DELETE() {
        throw new RESTMethodNotImplementedException ('Promocao', 'DELETE');
    }

    public function GET() {
        $db = Database::getDatabase();
        
        $result = Array();
        
        $st = $db->select('vencedores_promocao');
        
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) { 
            $result [] = (object) $row;
        }
        
        $this->setResult (
            array (
                'status' => 'OK',
                'content' => (object) $result
            )
        );
    }

    public function POST() {
        $sk = new SecureKeyAuth();
        $sd = new SecureDeviceHash();
        
        $sk->checkAuth();
        $sd->checkAuth();

        $params = getPostParams ();
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('Promocao', 'PUT');
    }

    public function getParams () {
        $params = array();

        if (isset($_POST['idartista'])) {
            $params ['idartista'] = intval($_POST['idartista']);
        }

        if (isset($_POST['iddevice'])) {
            $params ['iddevice'] = intval($_POST['iddevice']);
        }
    }

    public function getPostParams () {
        $params = array();
        
        if (isset($_POST['iddevice'])) {
            $params ['iddevice'] = intval($_POST['iddevice']);
        }

        if (isset($_POST['idartista'])) {
            $params ['idartista'] = intval($_POST['idartista']);
        }

        if (isset($_POST['nome'])) {
            $params ['nome'] = verify_security_string($_POST['nome']);
        }

        if (isset($_POST['celular'])) {
            $params ['celular'] = intval($_POST['celular']);
        }

        if (isset($_POST['texto'])) {
            $params ['texto'] = verify_security_string($_POST['texto']);
        }
                
        if (sizeof($params) != 5) {
            throw new RESTObjectException ('Missed params for POST method', 0);
        }
        
        return $params;
    }
}
