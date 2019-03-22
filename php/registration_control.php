<?php


$_SESSION['regError'] = [];
$regHiba = false;

require_once("../config/functions.php");
require_once('../config/connect.php');
session_start();
session_unset();

if (!isset($_POST['regSubmit'])) {
    header("Location: ../index.php");
    die();
}

$felhasznalo_nev = readPost('felhasznalo_nev');
$email = readPost('regEmail');
$pwd = readPost('regPassword');
$pwdc = readPost('ragPasswordConfirm');

if (strlen(felhasznalo_nev) < 5) {
    $regHiba = true;
}

if ($pwd == felhasznalo_nev) {
    setRegError('pwd', 'A felhasználónév és jelszó nem lehet azonos!');
}

if ($pwd != $pwdc) {
    setRegError('pwd', 'A két jelszó nem egyezik!');
}

$sql = "SELECT felhasznalo_nev FROM belepesi_adatok WHERE felhasznalo_nev = '$felhasznalo_nev'";
$result = $db_conn ->query($sql);
if (($result -> num_rows > 0) || ($felhasznalo_nev == "")) {
    $_SESSION['regError']['felhasznalo_nev'] = 'Már létezik ilyen felhasználó!';
}
if ($regHiba) {
    header("Location: ../index.php");
    die();
}
$pwd = readPost('regPassword');
$_SESSION['regError']['felhasznalo_nev'] = "";
$sql = "INSERT INTO belepesi_adatok (felhasznalo_nev,jelszo,jogosultsag,main_email) VALUES ('$felhasznalo_nev','$pwd',1,'$email')";
$result = $db_conn -> query($sql);

$_SESSION['success'] = true;
header("Location: ../index.php");
