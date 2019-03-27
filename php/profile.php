<?php
require_once('../config/connect.php');
session_start();
if (isset($_SESSION['felhasznalo_id'])) {
    $id = $_SESSION['felhasznalo_id'];
} else {
    header('Location: ../index.php');
    die();
}

$sql = "SELECT * FROM belepesi_adatok;";
$result = $db_conn->query($sql);
$numRows = $result->num_rows;

$sql = "SELECT * FROM belepesi_adatok WHERE felhasznalo_id LIKE '$id'";
$result = $db_conn->query($sql);

if ($result) {
    $input = "<form action='' method='POST'>"
            . "<h4 style='margin-bottom:2em;'>Felhasználói jelszó megváltoztatása</h4>"
            //. "<span id='successUpdate'></span><br>"
            . "<div id='area' class='col-lg-4'>"
            . "<div id='labelArea'>"
            . "<label class='updateData'>Felhasználónév:</label><br>"
            . "<label class='updateData'>Új jelszó:</label><br>"
            . "<label class='updateData'>Jelszó megerősítése:</label><br>"
            . "</div>";
    while ($row = $result->fetch_assoc()) {
        $input .= "<div id='inputArea'>"
                . "<input value=\"" . $row['felhasznalo_nev'] . "\"><br>"
                . "<input type='password' id='updatePassword' name='updatePassword' onblur='updatePasswordCheck()' required><br>"
                . "<input type='password' id='updatePasswordConfirm' name='updatePasswordConfirm' onblur='updatePasswordConfirmCheck()' required>"
                . "</div>"
                . "</div>";
    }
    $input .= "<div id='buttonArea' class='col-lg-4'>"
            . "<span id='updatePasswordError'></span><br>"
            . "<span id='updatePasswordConfirmError'></span><br>"
            . "<input type='submit' class='buttonUpdate' name='updateSubmit' value='Mentés'>"
            . "</div>"
            . "</form>";
}
//value=\"" . $row['jelszo'] . "\"
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
        <script src="../js/update_pw_validation.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>
    <body id="profile" style="background-image: url(../img/profile3.jpg)">
        <?php
        $menu = file_get_contents("../html/loggedin_menu.html");
        echo $menu;
        ?>
        <?php
        if (isset($_POST['updateSubmit'])) {
            //$succesMessage = $_POST['successUpdate'];;
            $updatePassword = $_POST['updatePassword'];
            $updatePasswordConfirm = $_POST['updatePasswordConfirm'];
            if($updatePassword != $updatePasswordConfirm) {
                header ("Location: profile.php");
                die();
            }
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
            //echo $succesMessage = "Sikeresen módosítottad jelszavad!";
        }

        echo "<h1 style='padding-top:3em;'></h1>";
        echo $input;
        $footer = file_get_contents("../html/footer.html");
        echo "<div style='position:fixed;left:0;bottom:0;'>$footer</div>";
        //$statement->close();
        $db_conn->close();
        ?>
    </body>
</html>