<?php

$server = "localhost";
$user = "root";
$password = "";
$dbName = "db_taskmaster";
$port = "3306";

$db_conn = new mysqli($server, $user, $password, $dbName, $port);
if ($db_conn->connect_errno) {
    die("Nem sikerült csatlakozni!" . $db->connect_error);
}
$db_conn->set_charset("utf8");

date_default_timezone_set('Europe/Budapest');

function fetch_legutobbi_aktivitas($felhasznalo_id, $db_conn) {
    $query = "SELECT * FROM belepes_reszletek WHERE felhasznalo_id = '$felhasznalo_id' ORDER BY legutobbi_aktivitas DESC LIMIT 1";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    foreach ($result as $row) {
        return $row['legutobbi_aktivitas'];
    }
}

function fetch_message($kitol_id, $kinek_id, $db_conn) {
    $query = "SELECT * FROM uzenetek WHERE  (kitol_id = '" . $kitol_id . "' AND kinek_id = '" . $kinek_id . "') OR (kitol_id = '" . $kinek_id . "' AND kinek_id = '" . $kitol_id . "')  ORDER BY idobelyeg DESC";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    $tabla = '<ul class="list-unstyled">';
    foreach ($result as $row) {
        $felhasznalo_nev = '';
        if ($row["kitol_id"] == $kitol_id) {
            $felhasznalo_nev = '<b class="text-success">Te</b>';
        } else {
            $felhasznalo_nev = '<b class="text-danger">' . get_felhasznalo_nev($row['kitol_id'], $db_conn) . '</b>';
        }
        $tabla .= '<li style="border-bottom:1px dotted #ccc">'
                . '<p>' . $felhasznalo_nev . ' - ' . $row["uzenet"] . ''
                . '<div align="right">'
                . '- <small><em>' . $row['idobelyeg'] . '</em></small>'
                . '</div>'
                . '</p>'
                . '</li>';
    }
    $tabla .= '</ul>';
    $query = "UPDATE uzenetek SET statusz = '0' WHERE kitol_id = '" . $kinek_id . "' AND kinek_id = '" . $kitol_id . "' AND statusz = '1'";
    $result = $db_conn->query($query);
    $tabla .= '</ul>';
    return $tabla;
}

function get_felhasznalo_nev($felhasznalo_id, $db_conn) {
    $query = "SELECT felhasznalo_nev FROM belepesi_adatok WHERE felhasznalo_id = '$felhasznalo_id'";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    foreach ($result as $row) {
        return $row['felhasznalo_nev'];
    }
}

function olvasatlan_uzenetek($kitol_id, $kinek_id, $db_conn) {
    $query = "SELECT * FROM uzenetek WHERE kitol_id = '$kitol_id' AND kinek_id = '$kinek_id' AND statusz = '1'";
    $statement = $db_conn->query($query);
    //$statement->execute();
    $count = $statement->num_rows;
    $tabla = '';
    if ($count > 0) {
        $tabla = '<span class="label label-success">' . $count . '</span>';
    }
    return $tabla;
}

?>
