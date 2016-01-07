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
class VencedoresDaPromocao extends RESTObject {
    public function DELETE() {
        throw new RESTMethodNotImplementedException ('VencedoresDaPromocao', 'DELETE');
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
        throw new RESTMethodNotImplementedException ('VencedoresDaPromocao', 'POST');
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('VencedoresDaPromocao', 'PUT');
    }
}
