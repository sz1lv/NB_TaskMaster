<?php

$server = "localhost";
$user = "root";
$password = "";
$dbName = "db_taskmaster";
$port = "3306";

$db_conn = new mysqli($server, $user, $password, $dbName, $port);
if ($db_conn->connect_errno) {
    die("Nem sikerült csatlakozni!" . $db->connect_error);
}
$db_conn->set_charset("utf8");

date_default_timezone_set('Europe/Budapest');

function fetch_legutobbi_aktivitas($felhasznalo_id, $db_conn) {
    $query = "SELECT * FROM belepes_reszletek WHERE felhasznalo_id = '$felhasznalo_id' ORDER BY legutobbi_aktivitas DESC LIMIT 1";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    foreach ($result as $row) {
        return $row['legutobbi_aktivitas'];
    }
}

?>
