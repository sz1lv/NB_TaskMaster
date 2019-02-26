<?php

include('../config/connect.php');
session_start();
$query = "
UPDATE belepes_reszletek SET legutobbi_aktivitas = now() WHERE id = '".$_SESSION["id"]."'";
$result = $db_conn->query($query);

?>