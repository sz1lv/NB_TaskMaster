<?php
include("config/connect.php");

session_start();

if (!isset($_SESSION['felhasznalo_id'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>taskmaster</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" type="image/png" href="img/tm_logo7-1.png"/>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/custom.js"></script>
        <link rel="stylesheet" type="text/css" href="css/custom.css" media="all">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid logged">
            <div class="row col-lg-12 first">
                <div class="col-lg-4 mainmenu">
                    <ul class="menu">
                        <li class="logo"><img style="height:3em;" src="img/tm_logo7-1.png"><a href="loggedin.php">taskmaster</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mainmenu">
                    <ul class="menu">
                        <li><a href="dolgozok.php">Munkatársaink</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mainmenu">
                    <form method="POST" action="kilep.php">
                        <input class="button3" type="submit" value="Kijelentkezés" name="kijelentkezes">
                    </form>
                </div>
            </div>
            <div class="row col-lg-12 maintenance">
                <h3>Az oldal fejlesztés alatt!</h3>
                <div class="table-responsive">
                    <h4 align="center">Online felhasználók</h4>
                    <p align="left">Üdvözöljük - <?php echo $_SESSION['felhasznalo_nev']; ?></p>
                    <div id="user_details"></div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {

                fetch_user();

                //5mp-ként frissíti a státuszt
                setInterval(function () {
                    update_activity();
                    fetch_user();
                }, 5000);

                function fetch_user()
                {
                    $.ajax({
                        url: "php/fetch_user.php",
                        method: "POST",
                        success: function (data) {
                            $('#user_details').html(data);
                        }
                    })
                }

                function update_activity()
                {
                    $.ajax({
                        url: "php/update_activity.php",
                        success: function ()
                        {

                        }
                    })
                }

            });
        </script>
    </div>
</body>
</html>


