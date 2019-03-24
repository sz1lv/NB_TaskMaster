<?php

session_start();
session_unset();
$_SESSION['regError'] = [];
$regHiba = false;

include('../config/functions.php');
include('../config/connect.php');

if (!isset($_POST['regSubmit'])) {
    header("Location: ../index.php");
    die();
}

$regName = $_POST['regName'];
$regEmail = $_POST['regEmail'];
$regPassword = $_POST['regPassword'];
$regPasswordConfirm = $_POST['regPasswordConfirm'];

if (strlen($regName) < 6) {
    $regHiba = true;
}

if ($regPassword == $regName) {
    setRegError('regPassword', 'A felhasználónév és jelszó nem lehet azonos!');
}

if ($regPassword != $regPasswordConfirm) {
    setRegError('regPassword', 'A két jelszó nem egyezik!');
}

$sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_nev = '$regName'";
$result = $db_conn->query($sql);
if (($result->num_rows > 0) || ($regName == "")) {
    $_SESSION['regError']['regName'] = 'Már létezik ilyen felhasználó!';
}
if ($regHiba) {
    header("Location: ../index.php");
    die();
}

$_SESSION['regError']['regName'] = "";
$sql = "INSERT INTO belepesi_adatok (felhasznalo_nev,jelszo,jogosultsag,main_email) VALUES ('$regName','$regPassword',1,'$regEmail')";
$result = $db_conn->query($sql);

$_SESSION['success'] = true;
header("Location: ../index.php");
