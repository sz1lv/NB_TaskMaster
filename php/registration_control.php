<?php

session_start();
session_unset();
//Szerveroldali validáció ellenőrzés hibeüzeneteit eltárolom egy tömbben
$_SESSION['regError'] = [];
//Kezdéskor ez nem valósul meg
$regHiba = false;

//Szükséges állományokat meghívom
include('../config/functions.php');
include('../config/connect.php');

//Ha nem kattintott a Regisztrációs gombra
if (!isset($_POST['regSubmit'])) {
    header("Location: ../index.php");
    die();
}
//Ellenben a beírt adatokat eltárolom változókban
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

//Megnézem, hogy létezik-e már ilyen felhasználó az adatbázisban
$sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_nev = '$regName'";
$result = $db_conn->query($sql);
//Amiben eltárolom az adatokat, sor szinten vizsgálom, ha adott név többször kerülne be, errort dob
if (($result->num_rows > 0) || ($regName == "")) {
    $_SESSION['regError']['regName'] = 'Már létezik ilyen felhasználó!';
}
if ($regHiba) {
    header("Location: ../index.php");
    die();
}

//$regPassword = readPost('regPassword');
//$regPassword = password_hash($regPassword, PASSWORD_BCRYPT);
//Új felhasználó regisztrálása
//A jogosultsága mindig 1, azaz user lesz
$_SESSION['regError']['regName'] = "";
$sql = "INSERT INTO belepesi_adatok (felhasznalo_nev,jelszo,jogosultsag,main_email) VALUES ('$regName','$regPassword',1,'$regEmail')";
$result = $db_conn->query($sql);

$_SESSION['success'] = true;
header("Location: ../index.php");
