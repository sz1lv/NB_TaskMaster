<?php
require_once("../config/connect.php");
session_start();
//Vizsgálom, hogy adott felhasználó belépett-e, csak akkor engedem erre az oldalra
if (!isset($_SESSION['felhasznalo_id'])) {
    header("location: ../index.php");
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
<!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" media="all">
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="../css/custom.css" media="all">

        <!--        jQuery library-->
<!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="../js/jquery-1.12.4.js"></script>
        <!--        JQuery UI Dialog box plugin-->
<!--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/custom.js"></script>

    </head>
    <body>
        <?php
        //Menüszerkezet meghívása és megjelenítése
        $menu = file_get_contents("../html/loggedin_menu.html");
        echo $menu;
        ?>
        <div class="row col-lg-12 maintenance">
            <h3></h3>
            <div class="table-responsive">
                <h4 align="center">Felhasználók</h4>
                <p class="welcome_user">Üdv <?php echo $_SESSION['felhasznalo_nev'];?>!</p>
                <div id="user_details"></div>
                <div id="user_model_details"></div>
            </div>
        </div>
        <?php
        $footer = file_get_contents("../html/footer.html");
        echo $footer;
        ?>
    </body>
</html>
<script>
    $(document).ready(function () {

        fetch_user();

        // Felhasználó aktivitása 2 másodpercenként frissül
        // Függvények meghívása, hogy ezt megtudjam jeleníteni
        setInterval(function () {
            update_last_activity();
            fetch_user();
            update_message();
        }, 2000);


        function fetch_user()
        {
            $.ajax({
                url: "fetch_user.php",
                method: "POST",
                success: function (data) {
                    $('#user_details').html(data);
                }
            });
        }

        //Aktivitás frissítése
        function update_last_activity()
        {
            $.ajax({
                url: "update_activity.php",
                success: function ()
                {

                }
            });
        }

        //Kialakítom a chat-box kinézetét, meghívom a megfelelő felhasználót, üzenet megjelenítése
        //Az egészet eltárolom a chat_ablak változóban
        function chat_box(kinek_id, kinek_nev)
        {
            var chat_ablak = '<div id="user_dialog_' + kinek_id + '" class="user_dialog" title="Csevegés vele: ' + kinek_nev + '">';
            chat_ablak += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-kinekid="' + kinek_id + '" id="chat_history_' + kinek_id + '">';
            chat_ablak += fetch_message(kinek_id);
            chat_ablak += '</div>';
            chat_ablak += '<div class="form-group">';
            chat_ablak += '<textarea name="uzenet' + kinek_id + '" id="uzenet' + kinek_id + '" class="form-control"></textarea>';
            chat_ablak += '</div><div class="form-group" align="right">';
            chat_ablak += '<button type="button" name="send_chat" id="' + kinek_id + '" class="btn btn-info send_chat">Küldés</button></div></div>';
            $('#user_model_details').html(chat_ablak);
        }

        //Kattintásra a párbeszédablak megjelenik
        $(document).on('click', '.start_chat', function () {
            var kinek_id = $(this).data('kinekid');
            var kinek_name = $(this).data('kineknev');
            chat_box(kinek_id, kinek_name);
            $("#user_dialog_" + kinek_id).dialog({
                autoOpen: false,
                width: 400
            });
            $('#user_dialog_' + kinek_id).dialog('open');
        });

        //Meghívott insert_chat.php-val a megfelelő szöveg jelenik meg kliensoldalon és tárolódik az adatbázisban is
        $(document).on('click', '.send_chat', function () {
            var kinek_id = $(this).attr('id');
            var uzenet = $('#uzenet' + kinek_id).val();
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                data: {kinek_id: kinek_id, uzenet: uzenet},
                success: function (data)
                {
                    $('#uzenet' + kinek_id).val('');
                    $('#chat_history_' + kinek_id).html(data);
                }
            })
        });


        function fetch_message(kinek_id)
        {
            $.ajax({
                url: "fetch_message.php",
                method: "POST",
                data: {kinek_id: kinek_id},
                success: function (data) {
                    $('#chat_history_' + kinek_id).html(data);
                }
            })
        }

        function update_message()
        {
            $('.chat_history').each(function () {
                var kinek_id = $(this).data('kinekid');
                fetch_message(kinek_id);
            });
        }

        //Párbeszédablak bezárása
        $(document).on('click', '.ui-button-icon', function () {
            $('.user_dialog').dialog('destroy').remove();
        });
    });
</script>

