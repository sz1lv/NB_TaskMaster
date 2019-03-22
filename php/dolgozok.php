<?php

require_once('../config/connect.php');
session_start();
if (isset($_SESSION['felhasznalo_id'])) {
    $id = $_SESSION['felhasznalo_id'];

} else {
    header('Location: ../index.php');
    die();
    //$menu = file_get_contents("html/logout.html");
}

$sql = "SELECT * FROM dolgozo;";
$result = $db_conn->query($sql);
$numRows = $result->num_rows;

if (isset($_GET['szures'])) {
    $lakohely = $_GET['lakohely'];
} else {
    $lakohely = "%";
}

$sql = "SELECT * FROM dolgozo WHERE lakohely LIKE '$lakohely'";
$result = $db_conn->query($sql);

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/custom.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>
    <body>
        <?php
        $menu = file_get_contents("loggedin.php");
        echo $menu;
        ?>
            <?php
            $urlap = "<form method='GET' action='dolgozok.php'>";
            $sql = "SELECT DISTINCT lakohely FROM dolgozo;";
            $result = $db_conn->query($sql);
            if ($result) {
                $urlap .= "<select class='szures' name='lakohely'>";
                while ($row = $result->fetch_row()) {
                    $urlap .= "<option>{$row[0]}</option>";
                }
                $urlap .= "</select>";
                $urlap .= "<input class='szures_btn' type='submit' value='Szűrés' name='szures'>"
                        . "<input onClick='window.location.href='dolgozok.php'' class='szures_btn' type='submit' value='Összes' name='all'>"
                        . "</form>";
            }
            echo $urlap;
            echo "</div>";
            echo $tabla;
            ?>
    </body>
</html>