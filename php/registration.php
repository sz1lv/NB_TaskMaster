<?php

require_once("../config/functions.php");
require_once("../config/connect.php");
session_start();

if (isset($_SESSION['felhasznalo_id'])) {
    $menu = file_get_contents("loggedin.php");
} else {
    $menu = file_get_contents("../html/logout.html");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>taskmaster</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--        Favicon-->
        <link rel="shortcut icon" type="image/png" href="../img/tm_logo7-1.png"/>
        <!--        CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!--        jQuery library-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/custom.js"></script>
        <!--        JQuery UI Dialog box plugin-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    <body>
        <div class="container-fluid">

            <div class="row overlay">
                <div>
                    <?php
                    echo $menu;
                    ?>
                </div>
                    <div class="col-lg-4">
                        <div id="login">
                            <form id="outForm" method="POST" action="belep.php">
<!--                                <p class="text-danger"><?php echo $message; ?></p>-->
                                <label>Felhasználónév:</label>
                                <input class="form-control" type="text" name="felhasznalo_nev" placeholder="" required>
                                <label>Jelszó:</label>
                                <input class="form-control" type="password" name="jelszo" placeholder="" required>
                                <input class="button3" type="submit" value="Bejelentkezés" name="submit">
                            </form>
                        </div>
                    </div>
            </div>

            <div id="registration" class="row col-lg-12 container3" style="background-image: url('../img/tothebottom.jpg');">
                <div class="row col-lg-4">
                </div>
                <div class="row col-lg-4">
                    <form id="regForm" method="=POST" action="registration_control.php">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-2 col-form-label">Felhasználónév</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="felhasznalo_nev" class="form-control" id="regUser" placeholder="Felhasználónév">
                                <?php
                                if (isset($_SESSION['regError']['felhasznalo_nev'])) {
                                    echo "<span>" . $_SESSION['regError']['felhasznalo_nev'] . "</span>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-2 col-form-label">Email</label>
                                <input type="email" name="regEmail" class="form-control" id="regEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-2 col-form-label">Jelszó</label>
                                <input type="password" name="regPassword" class="form-control" id="regPassword" placeholder="Jelszó">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-2 col-form-label">Jelszó megerősítése</label>
                                <input type="password" name="regPasswordConfirm" class="form-control" id="regPasswordConfirm" placeholder="Jelszó megerősítése">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" name="regSubmit" class="btn btn-primary">Regisztráció</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<h1 style='color:red;'>Sikeres regisztráció!</h1>";
                }
                ?>
                <div class="row col-lg-4">
                </div>
            </div>

            <div id="footer" class="row col-lg-12">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4 connect-info">
                    <p>Helyszín: Szeged</p><br>
                    <p>Email:<a href="mailto:teszt@teszt.hu"> teszt@teszt.hu</a></p><br>
                    <p>Telefonszám: 0123456789</p>
                </div>
            </div>
            <div class="col-lg-12">
                <p class="copyright">Készítette: Vincze Szilvia</p>
            </div>
        </div>
    </body>
</html>