<?php

header("Content-Type: application/json");

$serial_dos_trios = array(
	4354013, // ok
	4354081, // ok
	4376498, // ok
	5271302, // ok
	4228086, // ---
	4354085, // ok
	4328604, // ok
	1242066  // ok
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