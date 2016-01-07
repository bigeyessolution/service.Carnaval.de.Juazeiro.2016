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
 * Description of ResultadoMomo
 *
 * @author vanlivre
 */
class ResultadoMomo extends RESTObject {
    public function DELETE() {
        throw new RESTMethodNotImplementedException ('ResultadoMomo', 'DELETE');
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
                'content' => (object) $result
            )
        );
    }

    public function POST() {
        throw new RESTMethodNotImplementedException ('ResultadoMomo', 'POST');
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('ResultadoMomo', 'PUT');
    }
}
