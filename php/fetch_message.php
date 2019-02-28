<?php

include('../config/connect.php');
session_start();
echo fetch_message($_SESSION['felhasznalo_id'], $_POST['kinek_id'], $db_conn);

?>