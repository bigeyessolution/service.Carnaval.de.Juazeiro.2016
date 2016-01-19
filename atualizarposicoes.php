#!/usr/bin/php
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

require_once __DIR__.'/environment.php';

$ch = curl_init();

$headers = array(
    "GET trios.php HTTP/1.0",
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: application/json",
    "Cache-Control: no-cache",
    "Pragma: no-cache"
); 

curl_setopt($ch, CURLOPT_URL, 'https://padme.rti4.com.br/trios.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP'); 

$lastpositions = json_encode(curl_exec($ch));

var_dump($lastpositions);

$trios = Application::getConf('trios');