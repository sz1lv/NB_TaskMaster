<?php
session_start();
require_once 'config/connect.php';
if (isset($_POST['submit'])) {
    $userN = $_POST['user'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_nev = '$userN' AND jelszo = '$pass'";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_row();
        $_SESSION['uid'] = $row['0'];
        header('Location: loggedin.php');
    } else {
        $_SESSION['error'] = 'Helytelen felhasználónév vagy jelszó!';
        header('Location: index.php');
    }
}
