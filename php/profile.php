<?php
require_once('../config/connect.php');
session_start();
if (isset($_SESSION['felhasznalo_id'])) {
    $id = $_SESSION['felhasznalo_id'];
} else {
    header('Location: ../index.php');
    die();
}

$sql = "SELECT * FROM dolgozo;";
$result = $db_conn->query($sql);
$numRows = $result->num_rows;

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
        $menu = file_get_contents("../html/loggedin_menu.html");
        echo $menu;
        ?>
        <h1>Hello.</h1>
        <?php
        ?>
    </body>
</html>