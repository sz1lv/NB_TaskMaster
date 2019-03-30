<?php

require_once('../config/connect.php');
session_start();
//Vizsgálom, hogy belépett-e valaki, cask akkor engedem erre az oldalra, egyébként nem
if (isset($_SESSION['felhasznalo_id'])) {
    $id = $_SESSION['felhasznalo_id'];
} else {
    header('Location: ../index.php');
    die();
    //$menu = file_get_contents("html/logout.html");
}

//Kilistázom és eltárolom a dolgozo tábla rekordjait
$sql = "SELECT * FROM dolgozo;";
$result = $db_conn->query($sql);
$numRows = $result->num_rows;

//Vizsgálom, haszánlta-e a felhaszánló a Szűrés gombot
if (isset($_GET['szures'])) {
    $lakohely = $_GET['lakohely'];
} else {
    $lakohely = "%";
}

//Lakóhely szerint rendezem a szűrést
$sql = "SELECT * FROM dolgozo WHERE lakohely LIKE '$lakohely'";
$result = $db_conn->query($sql);
//Kilistázott dolgozókat az alábbiak szerint jelenítem meg
//Táblázat létrehozása, fejléccel
if ($result) {
    $tabla = "<table id='employee'>"
            . "<tr>"
            . "<td>Id</td>"
            . "<td>Név</td>"
            . "<td>Születési dátum</td>"
            . "<td>Lakóhely</td>"
            . "<td>Telefonszám</td>"
            . "<td>Pozíció</td>"
            . "</tr>";
    //Amíg az adat tart, feltöltöm értékkel a cellákat a megfelelő asszociációstömb elemnév alapján
    while ($row = $result->fetch_assoc()) {
        $tabla .= "<tr>"
                . "<td>{$row['azonosito']}</td>"
                . "<td>{$row['nev']}</td>"
                . "<td>{$row['szul_datum']}</td>"
                . "<td>{$row['lakohely']}</td>"
                . "<td>{$row['telefonszam']}</td>"
                . "<td>{$row['pozicio']}</td>"
                . "</tr>";
    }
    $tabla .= "</table>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>taskmaster</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" type="image/png" href="../img/tm_logo7-1.png"/>
        <!-- jQuery library -->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/custom.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">
        <!-- Latest compiled and minified CSS -->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">

    </head>
    <body>
        <?php
        //Hozzáfűzöm a html-hez a megfelelő menüt és kiíratom
        $menu = file_get_contents("../html/loggedin_menu.html");
        echo $menu;
        ?>
        <?php
        //A korábban lakóhely szerint listázott szűrésnek grafikus elemeket adok, adatbázisból feltöltöm adattal
        $urlap = "<div class='container-fluid'>"
                . "<form method='GET' action=''>";
        $sql = "SELECT DISTINCT lakohely FROM dolgozo;";
        $result = $db_conn->query($sql);
        if ($result) {
            $urlap .= "<select class='szures' name='lakohely'>";
            while ($row = $result->fetch_row()) {
                $urlap .= "<option>{$row[0]}</option>";
            }
            $urlap .= "</select>";
            $urlap .= "<input class='szures_btn' type='submit' value='Szűrés' name='szures'>"
                    //Az összes elem megjelenítéséhez újratöltöm az oldalt, ami alapállapotba helyezi a szűrést
                    . "<input onClick='window.location.href='dolgozok.php'' class='szures_btn' type='submit' value='Összes' name='all'>"
                    . "</form>"
                    . "</div>";
        }
        echo $urlap;
        echo "</div>";
        echo $tabla;
        ?>
    </body>
</html>