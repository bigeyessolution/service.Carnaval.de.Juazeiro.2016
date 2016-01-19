<?php

header("Content-Type: application/json");

$serial_dos_trios = array(
	4354013, // check - Testado
	4354081, // check - Testado
	4376498, // check - Testado
	5271302, // check
	4228086, // check
	4354085, // check
	4328604, // check
	1242066// check
);

$dbuser = '';
$dbname = '';
$dbpass = '';
$host   = 'localhost';

$database = new PDO("mysql:dbname=$dbname;host=$host;port=3306;", $dbuser, $dbpass);

foreach ($serial_dos_trios as $serial) {
	$last_position = $database->query(
		"SELECT serial, date, lat, lng FROM last_positions WHERE serial = '$serial'"
	)->fetch();

	if ($last_position) {
		$lastpositions[] = (object) array(
			"serial" => $last_position['serial'],
			"date"   => $last_position['date'],
			"lat"    => $last_position['lat'],
			"lng"    => $last_position['lng'],
		);
	}
}

printjson_encode((object) array(
		"status" => "OK",
		"time"   => time(),
		"trios"  => $lastpositions
	));