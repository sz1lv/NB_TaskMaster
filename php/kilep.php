<?php
session_start();
//Ahol meghívom ezt az állományt, bezárja a futó session-t és az index.php-ra irányít
session_destroy();
header('Location: ../index.php');
