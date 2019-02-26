<?php

$server = "localhost";
$user = "root";
$password = "";
$dbName = "db_taskmaster";
$port = "3306";

$db = new mysqli($server, $user, $password, $dbName, $port);
if ($db->connect_errno) {
    die("Nem sikerült csatlakozni!" . $db->connect_error);
}
$db->set_charset("utf8");

date_default_timezone_set('Europe/Budapest');

function fetch_legutobbi_aktivitas($felhasznalo_id, $db) {
    $query = "SELECT * FROM belepes_reszletek WHERE felhasznalo_id = '$felhasznalo_id' ORDER BY legutobbi_aktivitas DESC LIMIT 1";
    $result = $db->query($query);
    $row = $result->fetch_row();
    foreach ($result as $row) {
        return $row[2];
    }
}
