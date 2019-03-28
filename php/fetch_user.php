<?php

// Szükséges csatlakozási adatok
require_once("../config/connect.php");
session_start();
// Kilistázom a felhasználókat
$query = "SELECT * FROM belepesi_adatok WHERE felhasznalo_id != '" . $_SESSION['felhasznalo_id'] . "'";
$result = $db_conn->query($query);
$row = $result->fetch_assoc();

// A kilistázott felhasználókat táblázatban jelenítem meg
$tabla = '<table class="table table-bordered table-striped">'
        . '<tr>'
        . '<td>Felhasználónév</td>'
        . '<td class="user_col">Státusz</td>'
        . '<td class="user_col">Tevékenység</td>'
        . '</tr>';

// Változókban eltárolom a Státusz és Tevékenység adatait
foreach ($result as $row) {
    $statusz = "";
    // 10 másodperces késleltetés a valós időhez képest
    $current_timestamp = strtotime(date('Y-m-d H:i:s') . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $legutobbi_aktivitas = fetch_legutobbi_aktivitas($row['felhasznalo_id'], $db_conn);
    // Aktivitás eldöntése
    if ($legutobbi_aktivitas > $current_timestamp) {
        $statusz = '<span class="p-2 mb-2 bg-success text-white">Online</span>';
    } else {
        $statusz = '<span class="p-2 mb-2 bg-secondary text-white">Offline</span>';
    }
    // Oszlopok adatokkal való feltöltése
    $tabla .= '<tr><td>' . $row['felhasznalo_nev'] . ' ' . olvasatlan_uzenetek($row['felhasznalo_id'], $_SESSION['felhasznalo_id'], $db_conn) . '</td>'
            . '<td class="user_col">' . $statusz . '</td>'
            . '<td class="user_col"><button type="button" class="btn btn-info btn-xs start_chat" data-kinekid="' . $row['felhasznalo_id'] . '" data-kineknev="' . $row['felhasznalo_nev'] . '">Üzenet küldése</button></td>'
            . '</tr>';
}
$tabla .= '</table>';
echo $tabla;

?>