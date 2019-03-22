<?php

include("../config/connect.php");
session_start();
$query = "SELECT * FROM belepesi_adatok WHERE felhasznalo_id != '" . $_SESSION['felhasznalo_id'] . "'";
$result = $db_conn->query($query);
$row = $result->fetch_assoc();

$tabla = '<table class="table table-bordered table-striped">'
        . '<tr>'
        . '<td>Felhasználónév</td>'
        . '<td>Státusz</td>'
        . '<td>Tevékenység</td>'
        . '</tr>';

foreach ($result as $row) {
    $statusz = "";
    $current_timestamp = strtotime(date('Y-m-d H:i:s') . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $legutobbi_aktivitas = fetch_legutobbi_aktivitas($row['felhasznalo_id'], $db_conn);
    if ($legutobbi_aktivitas > $current_timestamp) {
        $statusz = '<span class="p-2 mb-2 bg-success text-white">Online</span>';
    } else {
        $statusz = '<span class="p-2 mb-2 bg-danger text-white">Offline</span>';
    }
    $tabla .= '<tr><td>' . $row['felhasznalo_nev'] . ' ' . olvasatlan_uzenetek($row['felhasznalo_id'], $_SESSION['felhasznalo_id'], $db_conn) . '</td>'
            . '<td>' . $statusz . '</td>'
            . '<td><button type="button" class="btn btn-info btn-xs start_chat" data-kinekid="' . $row['felhasznalo_id'] . '" data-kineknev="' . $row['felhasznalo_nev'] . '">Üzenet küldése</button></td>'
            . '</tr>';
}
$tabla .= '</table>';
echo $tabla;

?>