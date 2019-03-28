<?php

require_once('../config/connect.php');
session_start();
//Létrehozok egy változót, melyben később eltárolom az 'uzenetek' tábla értékeit
$data = array(
    $kinek_id = $_POST['kinek_id'],
    $kitol_id = $_SESSION['felhasznalo_id'], //Itt a küldőt jelzi
    $uzenet = $_POST['uzenet'],
    $statusz = '1'
);

//Új sor létrehozása adatbázisban, minden új üzenet esetén
$query = "INSERT INTO uzenetek (kinek_id, kitol_id, uzenet, statusz) VALUES (?,?,?,?)";
//$statement = $db_conn->prepare($query);
//$result = $statement->execute($data);
$statement = $db_conn->prepare($query);
//Paraméterezem, típust megadom az adatbevitelhez
$statement -> bind_param("iisi",$kinek_id,$kitol_id,$uzenet,$statusz);
if ($statement -> execute()) {
    echo fetch_message($_SESSION['felhasznalo_id'], $_POST['kinek_id'], $db_conn);
//    $statement->close();
//    $db_conn->close();
}
?>