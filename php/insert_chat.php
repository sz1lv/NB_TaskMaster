<?php

include('../config/connect.php');
session_start();

$data = array(
    $kinek_id = $_POST['kinek_id'],
    $kitol_id = $_SESSION['felhasznalo_id'],
    $uzenet = $_POST['uzenet'],
    $statusz = '1'
);

//if (isset($_POST['send_'])) {
//    $userN = $_POST['felhasznalo_nev'];
//    $pass = $_POST['jelszo'];

$query = "INSERT INTO uzenetek (kinek_id, kitol_id, uzenet, statusz) VALUES (?,?,?,?)";
//$statement = $db_conn->prepare($query);
//$result = $statement->execute($data);
$statement = $db_conn->prepare($query);
$statement -> bind_param("iisi",$kinek_id,$kitol_id,$uzenet,$statusz);
if ($statement -> execute()) {

    echo fetch_uzenet_tortenet($_SESSION['felhasznalo_id'], $_POST['kinek_id'], $db_conn);
    $statement->close();
    $db_conn->close();
}
?>