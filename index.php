<?php
include("config/connect.php");
include("config/functions.php");
session_start();

$message = "";

//Vizsgálom, hogy van-e már bejelentkezett felhasználó
if (isset($_SESSION['felhasznalo_id'])) {
    $menu = file_get_contents("php/loggedin.php");
} else {
    $menu = file_get_contents("html/logout.html");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>taskmaster</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--        Favicon-->
        <link rel="shortcut icon" type="image/png" href="img/tm_logo7-1.png"/>
        <!--        CSS-->
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="css/custom.css" media="all">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" media="all">
<!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <!--        jQuery library-->
<!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="js/jquery-1.12.4.js"></script>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/reg_validation.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        JQuery UI Dialog box js-->
<!--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

    </head>
    <body>
        <div class="container-fluid">

            <div class="row col-lg-12">
                <div>
                    <?php
                    //logout.html által meghatározott menüt jelenítem meg
                    echo $menu;
                    ?>
                </div>
                <div class="col-lg-12 main-image overlay" style="background-image: url('img/4k-desktop-background.jpg');">
                    <div class="row col-lg-12 buttonpart">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4 ">
                            <button class="button fade-in one" onclick="location.href = '#footer'">Kapcsolat</button>
                            <button class="button2 fade-in two" onclick="location.href = '#reklam'">Tudj meg többet</button>
                        </div>
                        <div class="col-lg-4">
                            <div id="login">
                                <form id="outForm" method="POST" action="php/belep.php">
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
                </div>
            </div>

            <div id="about" class="row col-lg-12 container">
                <div class="row col-lg-6">
                    <img class="big-logo" src="img/tm_logo7-2.png">
                </div>
                <div class="row col-lg-6">
                    <h3 class="who-are-we">Kik vagyunk mi?</h3>
                    <p class="test">Tudjuk, hogy fontos Neked a projekted követése!<br>Mi ebben próbálunk segíteni
                        olyan közeget biztosítva, mintha csak egy kávézóban beszélgetnénk.</p>
                </div>
            </div>

            <div id="us" class="row col-lg-12 container">
                <div class="row col-lg-8">
                    <p class="test">Egy letisztult, áttekinthető felület vár rád. Csatlakozz hozzánk!</p>
                </div>
                <div class="col-lg-4">
                    <button class="button3"><a href="#registration">Tovább</a></button>
                </div>
            </div>

            <div id="reklam" class="row col-lg-12 container">
                <div class="container">
                    <div class="row firstRow">
                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-synchronize-100.png">
                            </div>
                            <h3>Gyorsaság</h3>
                        </div>

                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-puzzle-100.png">
                            </div>
                            <h3>Hatékonyság</h3>
                        </div>

                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-lock-100.png">
                            </div>
                            <h3>Megbízhatóság</h3>
                        </div>
                    </div>
                    <div class="row secondRow">
                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-connect-filled-100.png">
                            </div>
                            <h3>Elérhetőség</h3>
                        </div>

                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-services-filled-100.png">
                            </div>
                            <h3>Megoldási javaslatok</h3>
                        </div>

                        <div class="col-lg-4">
                            <div class="ikon">
                                <img class="ikon" src="img/icons8-checkmark-100.png">
                            </div>
                            <h3>Elégedettség</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div id="registration" class="row col-lg-12 container3" style="background-image: url('img/tothebottom.jpg');">
                <div class="row col-lg-4">
                </div>
                <div class="row col-lg-4">
                    <form id="regForm" method="POST" action="php/registration_control.php">
                        <?php
                        if (isset($_SESSION['success'])) {
                            echo "<h1 class='success_text'>Sikeres regisztráció!</h1>";
                        } else {
                            echo "";
                        }
                        ?>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="regName" class="col-sm-2 col-form-label">Felhasználónév</label>
                                <input type="text" name="regName" class="form-control" id="regName" placeholder="Felhasználónév" onblur="usernameCheck()" required>
                                <span id="usernameError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="regEmail" class="col-sm-2 col-form-label">Email</label>
                                <input type="email" name="regEmail" class="form-control" id="regEmail" placeholder="Email" onblur="emailCheck()" required>
                                <span id="emailError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="regPassword" class="col-sm-2 col-form-label">Jelszó</label>
                                <input type="password" name="regPassword" class="form-control" id="regPassword" placeholder="Jelszó" onblur="passwordCheck()" required>
                                <span id="passwError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=">" class="col-sm-2 col-form-label">Jelszó megerősítése</label>
                                <input type="password" name="regPasswordConfirm" class="form-control" id="regPasswordConfirm" placeholder="Jelszó megerősítése" onblur="passwordConfirm()" required>
                                <span id="confirmError"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 col-form-label">&nbsp</label>
                                <button type="submit" name="regSubmit" value="Submit" class="btn btn-primary">Regisztráció</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row col-lg-4">
                </div>
            </div>

            <?php
            $footer = file_get_contents("html/footer.html");
            echo $footer;
            ?>
        </div>
        <script>
            // Smooth ugrás #-k között
            document.querySelector('.hello').scrollIntoView({
                behavior: 'smooth';
            });

            //Fő kép gombok feltűnése Chrome böngészőben
            $(document).ready(function () {
                $(window).onload(function () {
                    $('.button').fadeIn();
                    $('.button2').fadeIn('slow');
                });
            });

        </script>
    </body>
</html>