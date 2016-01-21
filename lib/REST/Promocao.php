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
                'content' => $result
            )
        );
    }

    public function POST() {
        $sk = new SecureKeyAuth();
        
        $sk->checkAuth();

        $params = $this->getPostParams ();
        
        $db = Database::getDatabase();
        
        $st = $db->prepare ('INSERT INTO '
        . 'promocao (idartista, nome, celular, texto)'
        . 'VALUES (:idartista, :nome, :celular, :texto)');
        
        $st->bindValue (':idartista', $params['idartista'], PDO::PARAM_INT);
        $st->bindValue (':nome', $params['nome'], PDO::PARAM_STR);
        $st->bindValue (':celular', $params['celular'], PDO::PARAM_STR);
        $st->bindValue (':texto', $params['texto'], PDO::PARAM_STR);
        
        if ($st->execute ()) {
            $this->setResult(array(
                'status' => 'OK',
                'message' => 'Mensagem cadastrada com sucesso.'
            )); 
        } else {
            $this->setResult($db->errorInfo());
        }
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

        if (isset($_POST['idartista'])) {
            $params ['idartista'] = intval($_POST['idartista']);
        }

        if (isset($_POST['nome'])) {
            $params ['nome'] = verify_security_string($_POST['nome']);
        }

        if (isset($_POST['celular'])) {
            $params ['celular'] = verify_security_string($_POST['celular']);
        }

        if (isset($_POST['texto'])) {
            $params ['texto'] = verify_security_string($_POST['texto']);
        }
                
        if (sizeof($params) != 4) {
            throw new RESTObjectException ('Missed params for POST method', 0);
        }
        
        return $params;
    }
}
