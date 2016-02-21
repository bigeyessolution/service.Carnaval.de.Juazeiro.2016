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
 * Description of Pesquisa
 *
 * @author vanlivre
 */
class Pesquisa extends RESTObject {
    public function DELETE() {
        throw new RESTMethodNotImplementedException ('Pesquisa', 'DELETE');
    }

    public function GET() {
//        throw new RESTMethodNotImplementedException ('Pesquisa', 'GET');
        
        $questoes = Application::getConf('questoes');
        
        $result = array();
        
        //@todo Pegar total de registros
        $db = Database::getDatabase();
        
        $total = $db->query('select count(*) from pesquisa')->fetchColumn();
                
        foreach ($questoes as $questao) {
            $numero = $questao->questao;
            $tabela = 'count_' . $questao->questao;
            $tipo = $questao->tipo;
            $descricao = $questao->descricao;
            
            $st = $db->query("select * from $tabela");
            
            if ($tipo == 'int') {
                $result[] = (object) array (
                    "questao" => $numero,
                    "descricao" => $descricao,
                    "respostas" => (array) $st->fetch(PDO::FETCH_ASSOC)
                );
            } else {
                $result[] = (object) array (
                    "questao" => $numero,
                    "descricao" => $descricao,
                    "respostas" => (object) $st->fetchAll(PDO::FETCH_OBJ)
                );
            }
        }
        
        $this->setResult(array (
            'status' => 'OK',
            'content' => (object) array (
                'votos' => $total,
                'respostas' => $result
            )
        ));
    }

    public function POST() {
//        throw new RESTMethodNotImplementedException ('Pesquisa', 'POST');
        
        $sk = new SecureKeyAuth();
        $sk->checkAuth();
        
        $params = $this->getPostParams();
        
        $fields = implode(',', array_keys($params));
        
        $keyparams = implode (',', array_map(function ($value) { return ':'.$value; }, array_keys($params)));
        
        $db = Database::getDatabase();
        
        try {
            $st = $db->prepare ("INSERT INTO pesquisa ($fields) VALUES ($keyparams)");
            
            foreach ($params as $field => $value) {
                $tipo = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                
                $st->bindValue (':'.$field, $value, $tipo);
            }
            
            if ($st->execute ()) {
                $this->setResult(array(
                    'status' => 'OK'
                )); 
            } else {
                //$this->setResult($db->errorInfo());
                
                $this->setResult(array(
                    'status' => 'ERROR',
                    'fields' => $fields,
                    'keyparams' => $keyparams,
                    'sqlerrorcode' => $db->errorCode()
                )); 
            }
            
        } catch (PDOException $ex) {            
            throw new RESTObjectException('Database insert fail');
        }
        
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('Pesquisa', 'PUT');
    }
    
    public function getPostParams () {
        $params = array();
        
        if (isset($_POST['q1'])) {
            $params ['q1'] = intval($_POST['q1']);
        }
        
        if (isset($_POST['q2'])) {
            $params ['q2'] = intval($_POST['q2']);
        }
        
        if (isset($_POST['q3'])) {
            $params ['q3'] = intval($_POST['q3']);
        }
        
        if (isset($_POST['q4'])) {
            $params ['q4'] = verify_security_string($_POST['q4']);
        }
        
        if (isset($_POST['q5'])) {
            $params ['q5'] = intval($_POST['q5']);
        }
        
        if (isset($_POST['q6'])) {
            $params ['q6'] = intval($_POST['q6']);
        }
        
        if (isset($_POST['q7'])) {
            $params ['q7'] = intval($_POST['q7']);
        }
        
        if (isset($_POST['q8'])) {
            $params ['q8'] = intval($_POST['q8']);
        }
        
        if (isset($_POST['q9a'])) {
            $params ['q9a'] = intval($_POST['q9a']);
        }
        
        if (isset($_POST['q9b'])) {
            $params ['q9b'] = intval($_POST['q9b']);
        }
        
        if (isset($_POST['q9c'])) {
            $params ['q9c'] = intval($_POST['q9c']);
        }
        
        if (isset($_POST['q9d'])) {
            $params ['q9d'] = intval($_POST['q9d']);
        }
        
        if (isset($_POST['q10a'])) {
            $params ['q10a'] = intval($_POST['q10a']);
        }
        
        if (isset($_POST['q10b'])) {
            $params ['q10b'] = intval($_POST['q10b']);
        }
        
        if (isset($_POST['q10c'])) {
            $params ['q10c'] = intval($_POST['q10c']);
        }
        
        if (isset($_POST['q10d'])) {
            $params ['q10d'] = intval($_POST['q10d']);
        }
        
        if (isset($_POST['q11a'])) {
            $params ['q11a'] = intval($_POST['q11a']);
        }
        
        if (isset($_POST['q11b'])) {
            $params ['q11b'] = intval($_POST['q11b']);
        }
        
        if (isset($_POST['q11c'])) {
            $params ['q11c'] = intval($_POST['q11c']);
        }
        
        if (isset($_POST['q11d'])) {
            $params ['q11d'] = intval($_POST['q11d']);
        }
        
        if (isset($_POST['q11e'])) {
            $params ['q11e'] = intval($_POST['q11e']);
        }
        
        if (isset($_POST['q11f'])) {
            $params ['q11f'] = intval($_POST['q11f']);
        }
        
        if (isset($_POST['q11g'])) {
            $params ['q11g'] = intval($_POST['q11g']);
        }
        
        if (isset($_POST['q11h'])) {
            $params ['q11h'] = intval($_POST['q11h']);
        }
        
        if (isset($_POST['q11i'])) {
            $params ['q11i'] = intval($_POST['q11i']);
        }
        
        if (isset($_POST['q12'])) {
            $params ['q12'] = verify_security_string ($_POST['q12']);
        }
        
//        if (sizeof($params) != 2) {
//            throw new RESTObjectException ('Missed params for POST method', 0);
//        }
        
        return $params;
    }
}
