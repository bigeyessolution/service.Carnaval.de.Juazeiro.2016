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
 * Description of VotarRei
 *
 * @author vanlivre
 */
class VotacaoMomo extends RESTObject {
    private $votacao;
    
    public function __construct() {
        $fimvotacao = Application::getConf('votacao')->fim;
        
        $agora = time();
        
        $this->votacao = $agora <= $fimvotacao;
    }

        public function DELETE() {
        throw new RESTMethodNotImplementedException ('VotarMomo', 'DELETE');
    }

    public function GET() {
        $db = Database::getDatabase();
        
        $result = Array();
        
        $st = $db->select('resultado_momo');
        
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) { 
            $result [] = (object) $row;
        }
        
        $this->setResult (
            array (
                'status' => 'OK',
                'votacao' => $this->votacao,
                'content' => (object) $result
            )
        );
    }

    public function POST() {
        $fim = Application::getConf('votacao')->fim;
        $agora = time;
        
        if ($agora > $fim) {
            throw new RESTObjectException ('Votações encerradas', $agora);
        }
        
        $sk = new SecureKeyAuth();
        $sd = new SecureDeviceHash();
        
        $sk->checkAuth();
        
        $sd->checkAuth();
        
        $params = $this->getPostParams();
        
        $db = Database::getDatabase();
        
        if ($db->select(
                'device_votou_momo', 
                "iddevice = ${params['iddevice']}"
            )->fetch()) {
           throw new RESTObjectException ('Você já votou para rainha');
        }
        
        try {
            $db->beginTransaction();
            
            $flag = false;
            
            //inserir registro votado
            $flag = $db->exec (
                    "INSERT INTO device_votou_momo (iddevice) VALUES (${params['iddevice']})") ? 
                    TRUE : FALSE;
            
            //inserir registro
            if ($flag) {
                $flag = $db->exec (
                        "INSERT INTO votos_momo (idmomo) VALUES (${params['idmomo']})") ? 
                        TRUE : FALSE;
            }
            
            if ($flag) {
                $db->commit();
            } else {
                $db->rollBack();
                throw new RESTObjectException('Database insert fail');
            }
            
            $this->GET();
        } catch (PDOException $ex) {
            $db->rollBack();
            
            throw new RESTObjectException('Database insert fail');
        }
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('VotarMomo', 'PUT');
    }
    
    public function getPostParams () {
        $params = array();
        
        if (isset($_POST['idmomo'])) {
            $params ['idmomo'] = intval($_POST['idmomo']);
        }
        
        if (isset($_POST['iddevice'])) {
            $params ['iddevice'] = intval($_POST['iddevice']);
        }
        
        if (sizeof($params) != 2) {
            throw new RESTObjectException ('Missed params for POST method', 0);
        }
        
        return $params;
    }
}
