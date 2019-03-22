<?php

session_start();
session_unset();
$_SESSION['regError'] = []; //létrehozunk egy tömböt, amiben eltároljuk a hibaüzenetet, amit a reg.php-ben határozunk meg, hogy mikor kapjuk
require_once("../config/functions.php");
require_once("../config/connect.php");
if (isset($_POST['regSubmit'])) {
        echo 'Nem kattintott?';
        header("Location: ../index.php");
         die();

}
$username = readPost('regUser');

$sql = "SELECT felhasznalo_nev FROM belepesi_adatok WHERE felhasznalo_nev = '$username'";
$result = $db_conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['regError']['regUser'] = "Már létezik ilyen felhasználó!";
    echo 'Van ilyen felhasználó.';
    header("Location: ../index.php");
}

$sql = "INSERT INTO belepesi_adatok (felhasznalo_nev,jelszo,jogosultsag,main_email) VALUES ('$username','123',1,'1')";
$result = $db_conn->query($sql); //elmentem a resultba

$_SESSION['success'] = true;
echo 'Itt lenne jóú.';
//header("Location: ../index.php");

//if (!empty($_POST['username'])) { //függvényt hoztunk létre a functions-php-ban, az inputok ellenőrzésére, hogy ne itt kelljen 7x lecopyzni
//    $username = $_POST['regUser'];
//}
?>
