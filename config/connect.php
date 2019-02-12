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
