<?php

function readPost($kulcs) {
    $temp = trim($_POST[$kulcs]);
    if (!empty($temp)) {
        return $temp;
    } else {
        $_SESSION['regError'][$kulcs] = "Kitöltetlen mező!";
    }
}
?>