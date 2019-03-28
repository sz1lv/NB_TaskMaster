<?php

// Kapcsolat létrehozása
require_once('../config/connect.php');
session_start();
//Ha rákattint a felhasználó a Bejelentkezés gombra, a rendszer azonosítja id alapján
if (isset($_POST['submit'])) {
    $userN = $_POST['felhasznalo_nev'];
    $pass = $_POST['jelszo'];
    $sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_nev = '$userN' AND jelszo = '$pass'";
    $result = $db_conn->query($sql);
    //Belépés után eltárolom, hogy ki mikor lépett be, ami a felhaszánló aktivitási státuszának meghatározásához kell
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['felhasznalo_id'] = $row['felhasznalo_id'];
        $_SESSION['felhasznalo_nev'] = $row['felhasznalo_nev'];
        $sub_query = "INSERT INTO belepes_reszletek (felhasznalo_id) VALUES ('".$row['felhasznalo_id']."')";
        $statement = $db_conn->prepare($sub_query);
        $statement->execute();
        //Bejelentkezett felhasználó id beszúrása
        $_SESSION['id'] = $db_conn-> insert_id;
        header('Location: loggedin.php');
    } else {
        //Adat összeegyeztethetetlenség esetén a rendszer nem lépteti be a felhasználót, újratölti az idex.php-t
        $_SESSION['error'] = 'Helytelen felhasználónév vagy jelszó!';
        header('Location: ../index.php');
    }
}
