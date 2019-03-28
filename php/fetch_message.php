<?php

require_once('../config/connect.php');
session_start();
//Üzenetküldésnél a küldő és címzett meghatározása
echo fetch_message($_SESSION['felhasznalo_id'], $_POST['kinek_id'], $db_conn);

?>