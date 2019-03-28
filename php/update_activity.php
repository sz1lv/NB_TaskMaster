<?php

require_once('../config/connect.php');
session_start();
//Adott felhasználó újbóli, legutolsó belépését regisztrálom az adatbázisban
$query = "UPDATE belepes_reszletek SET legutobbi_aktivitas = now() WHERE id = '".$_SESSION["id"]."'";
$result = $db_conn->query($query);

?>