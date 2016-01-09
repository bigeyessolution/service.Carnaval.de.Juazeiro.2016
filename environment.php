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

date_default_timezone_set ('America/Bahia');

define("BASEDIR", __DIR__.'/');
define ("CONFDIR", BASEDIR.'conf/');
define ("LIBDIR", BASEDIR.'lib/');
define ("RESTDIR", LIBDIR.'REST/');

function __autoload ($class_name) {
    require_once LIBDIR . "$class_name.php";
}

// - Required classes
//require_once \LIBDIR.'Application.php';
//require_once \LIBDIR.'Database.php';
//require_once \LIBDIR.'RESTObject.php';
//require_once \LIBDIR.'Exceptions/RESTObjectException.php';
//require_once \LIBDIR.'Exceptions/RESTMethodNotImplemented.php';
//require_once \LIBDIR.'Router.php';

// - Other required scripts
require_once \LIBDIR.'system_functions.php';