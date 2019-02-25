<?php

require_once '../config/connect.php';

session_start();

$query = "SELECT felhasznalo_nev FROM belepesi_adatok WHERE azonosito != '" . $_SESSION['azonosito'] . "'";

$result = $db->query($query);
$row = $result->fetch_row();

$output = '<table class="table table-bordered table-striped">'
        . '<tr>'
        . '<td>Felhasználónév</td>'
        . '<td>Státusz</td>'
        . '<td>Tevékenység</td>'
        . '</tr>';

foreach ($result as $row) {
    $output .= '
 <tr>
  <td>' . $row['felhasznalo_nev'] . '</td>
  <td></td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-tousername="' . $row['felhasznalo_nev'] . '">Üzenet küldése</button></td>
 </tr>
 ';
//    data-touserid="' . $row['azonosito'] . '"
}

$output .= '</table>';

echo $output;
?>