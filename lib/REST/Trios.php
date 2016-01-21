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
 * Description of Trios
 *
 * @author vanlivre
 */
class Trios extends RESTObject {

    public function DELETE() {
        throw new RESTMethodNotImplementedException ('Trios', 'DELETE');
    }

    public function GET() {
        $trios = Application::getConf('lastpositions')->trios;
        
        $result_trios = array ();
        
        foreach ($trios as $trio) {
            $artista = $this->getArtista ($trio->serial);
            
            if ($artista !== FALSE) {
                $result_trios[] = (object) array (
                    "serial" => $trio->serial,
                    "lat" => $trio->lat,
                    "lng" => $trio->lng,
                    "idartista" => $artista->idartista,
                    "artista" => $artista->nome
                );
            } else {
                $result_trios[] = (object) array (
                    "serial" => $trio->serial,
                    "lat" => $trio->lat,
                    "lng" => $trio->lng,
                    "idartista" => false,
                    "artista" => false
                );
            }
        }
        
        $this->setResult(array ("status" => "OK", "content" => $result_trios));
    }

    public function POST() {
        throw new RESTMethodNotImplementedException ('Trios', 'POST');
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('Trios', 'PUT');
    }
    
    private function getArtista ($serial) {
        $trios = Application::getConf('trios');
        
        $artistas = FALSE;
        
        foreach ($trios as $trio) {
            if ($trio->serial == $serial) {
                $artistas = $trio->artistas;
                
                break;
            }
        }
        
        if ($artistas == FALSE) {
            throw new RESTObjectException("Trio não encontrado");
        }
        
        $agora = time();
        
        foreach ($artistas as $artista) {
            if ($artista->inicio <= $agora and $agora <= $artista->fim) {
                return $artista;
            }
            
            return FALSE;
        }
    }
}
