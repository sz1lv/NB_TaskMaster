<?php

include('config/connect.php');
session_start();
if (isset($_POST['submit'])) {
    $userN = $_POST['felhasznalo_nev'];
    $pass = $_POST['jelszo'];
    $sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_nev = '$userN' AND jelszo = '$pass'";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_row();
        $_SESSION['felhasznalo_id'] = $row['0'];
        $_SESSION['felhasznalo_nev'] = $row['1'];
        header('Location: loggedin.php');
    } else {
        $_SESSION['error'] = 'Helytelen felhasználónév vagy jelszó!';
        header('Location: index.php');
    }
}
