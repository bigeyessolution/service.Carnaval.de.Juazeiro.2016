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
 * Description of Index
 *
 * @author vanlivre
 */
class Index extends RESTObject {

    public function DELETE() {
        throw new RESTMethodNotImplementedException ('Index', 'DELETE');
    }

    public function GET() {
        $this->setResult(file_get_contents('index.html'));
//        $this->setContentType(self::HTML_CONTENT_TYPE);
//        
//        $this->setResult('<html><title>#CarnaJua2016</title><body>'
//                . ''
//                . '</body></html>');
        
        //header('Location: http://www2.juazeiro.ba.gov.br', TRUE);
    }

    public function POST() {
        throw new RESTMethodNotImplementedException ('Index', 'POST');
    }

    public function PUT() {
        throw new RESTMethodNotImplementedException ('Index', 'PUT');
    }

}
