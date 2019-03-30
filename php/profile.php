<?php
require_once('../config/connect.php');
session_start();
//Ellenőrzöm, belépett-e a felhasználó
if (isset($_SESSION['felhasznalo_id'])) {
    $id = $_SESSION['felhasznalo_id'];
} else {
    header('Location: ../index.php');
    die();
}

//Itt a 'belepesi_adatok' rekonrdjait kérem le és tárolom el
$sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_id LIKE '$id';";
$result = $db_conn->query($sql);
$numRows = $result->num_rows;

//$sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_id LIKE '$id'";
//$result = $db_conn->query($sql);

//Az eltárolt adat megjelenítése
if ($result) {
    $input = "<form action='' method='POST'>"
            . "<h4 style='margin-bottom:2em;'>Felhasználói jelszó megváltoztatása</h4>"
            . "<div id='area' class='col-lg-4'>"
            . "<div id='labelArea'>"
            . "<label class='updateData'>Felhasználónév:</label><br>"
            . "<label class='updateData'>Új jelszó:</label><br>"
            . "<label class='updateData'>Jelszó megerősítése:</label><br>"
            . "</div>";
    while ($row = $result->fetch_assoc()) {
        $input .= "<div id='inputArea'>"
                //Csak a bejelentkezett felhasználó nevét jelenítem meg, amit nem lehet megváltoztatni
                . "<input class='readonlyUserName' value=\"" . $row['felhasznalo_nev'] . "\" readonly><br>"
                //Jelszó mezők üresek, az ide beírt és validált új jelszó mentésre kerül az adatbázisba
                . "<input type='password' id='updatePassword' name='updatePassword' onblur='updatePasswordCheck()' required><br>"
                . "<input type='password' id='updatePasswordConfirm' name='updatePasswordConfirm' onblur='updatePasswordConfirmCheck()' required>"
                . "</div>"
                . "</div>";
    }
    //Validálási hiba esetén az alább létrehozott grafikai elemekben jelenítem meg a hibaüzenetet
    $input .= "<div id='buttonArea' class='col-lg-4'>"
            . "<span id='updatePasswordError'></span><br>"
            . "<span id='updatePasswordConfirmError'></span><br>"
            . "<input type='submit' class='buttonUpdate' name='updateSubmit' value='Mentés'>"
            . "</div>"
            . "</form>";
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
        <script src="../js/update_pw_validation.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">
        <!-- Latest compiled and minified CSS -->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">

    </head>
    <body id="profile" style="background-image: url(../img/profile3-min.jpg)">
        <?php
        //Menü behúzása
        $menu = file_get_contents("../html/loggedin_menu.html");
        echo $menu;
        ?>
        <?php
        //Mentés gomb kattintás esemény
        if (isset($_POST['updateSubmit'])) {
            //$succesMessage = $_POST['successUpdate'];;
            $updatePassword = $_POST['updatePassword'];
            $updatePasswordConfirm = $_POST['updatePasswordConfirm'];
            //Ha nem egyeznek a jelszavak, nem kerül frissítésre az adatbázisban, újra kell próbálkozni
            if($updatePassword != $updatePasswordConfirm) {
                header ("Location: profile.php");
                die();
            }
            //Ellenkező esetben az adatbázisban frissül ezen adat
            $id = $_SESSION['felhasznalo_id'];
            $updatePassword = $_POST['updatePassword'];
            $query = "UPDATE belepesi_adatok SET jelszo= ? WHERE felhasznalo_id = ?";
            $statement = $db_conn->prepare($query);
            $statement->bind_param("si", $updatePassword, $id);
            while ($row = $statement->fetch()) {
                $input .= "<input name='updatePassword' value=\"" . $updatePassword . "\"><br>"
                        . "<input name='updatePassword'>";
            }
            $result = $statement->execute();
        }

        echo "<h1 style='padding-top:3em;'></h1>";
        //Jelszó módosítás form megjelenítése kliensoldalon
        echo $input;
        //Footer meghívása és megjelenítése
        $footer = file_get_contents("../html/footer.html");
        echo "<div style='position:fixed;left:0;bottom:0;'>$footer</div>";
        //$statement->close();
        $db_conn->close();
        ?>
    </body>
</html>