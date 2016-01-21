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
 * Description of PromocaoControle
 *
 * @author vanlivre
 */
class PromocaoControle extends RESTObject {

    public function DELETE() {
        throw new RESTMethodNotImplementedException ('PromocaoControle', 'DELETE');
    }

    public function GET() {
        (new SecureKeyAuth)->checkAuth();
        
        $database = Database::getDatabase();
        
        $result = array ();
        
        $st = $db->select('lista_promocao');
        
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
        (new SecureKeyAuth)->checkAuth();
        
        $params = $this->getPOSTParams();
        
        $db = Database::getDatabase();
        
        $st = $db->prepare ('UPDATE promocao SET escolhido = :escolhido WHERE sequencia = :sequencia');
        
        $st->bindValue (':escolhido', $params['escolhido'], PDO::PARAM_BOOL);
        $st->bindValue (':sequencia', $params['sequencia'], PDO::PARAM_INT);
        
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
        throw new RESTMethodNotImplementedException ('PromocaoControle', 'PUT');
    }
    
    private function getPOSTParams () {
        if (isset($_POST['sequencia'])) {
            $params ['sequencia'] = intval($_POST['sequencia']);
        }
        
        if (isset($_POST['escolhido'])) {
            $params ['escolhido'] = $_POST['escolhido'] == TRUE;
        }
        
        if (sizeof($params) != 2) {
            throw new RESTObjectException ('Missed params for POST method', 0);
        }
        
        return $params;
    }

}
