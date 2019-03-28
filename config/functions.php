<?php

// Teszt
function dd($var) {
    var_dump($var);
    die();
}

// Szerveroldali ellenőrzés a regisztrációs formnál
function readPost($kulcs) {
    $temp = trim($_POST[$kulcs]);
    if (!empty($temp)) {
        return $temp;
    } else {
        $_SESSION['regError'][$kulcs] = 'Kitöltetlen mező!';
    }
}

// Szerveroldali ellenőrzés a regisztrációs formnál
function setRegError($kulcs, $msg) {
    if (isset($_SESSION['regError'][$kulcs])) {
        $_SESSION['regError'][$kulcs] .= $msg;
    } else {
        $_SESSION['regError'][$kulcs] .= $msg;
    }
    return true;
}