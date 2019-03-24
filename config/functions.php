<?php

function dd($var) {
    var_dump($var);
    die();
}

function readPost($kulcs) {
    $temp = trim($_POST[$kulcs]);
    if (!empty($temp)) {
        return $temp;
    } else {
        $_SESSION['regError'][$kulcs] = 'Kitöltetlen mező!';
    }
}

function setRegError($kulcs, $msg) {
    if (isset($_SESSION['regError'][$kulcs])) {
        $_SESSION['regError'][$kulcs] .= $msg;
    } else {
        $_SESSION['regError'][$kulcs] .= $msg;
    }
    return true;
}