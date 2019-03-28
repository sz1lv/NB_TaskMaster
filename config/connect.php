<?php

// Adatbázis kapcsoloat adatai
$server = "localhost";
$user = "sze7vinszi";
$password = "sze7vinszi";
$dbName = "db_taskmaster";
$port = "3306";

// Kapcsolat létrehozása, példányosítása paraméterekkel
$db_conn = new mysqli($server, $user, $password, $dbName, $port);
if ($db_conn->connect_errno) {
    die("Nem sikerült csatlakozni!" . $db->connect_error);
}
$db_conn->set_charset("utf8");

// Alapértelmezett időzóna megadása (valósidejű üzenetek pontos küldési idejének meghatározásához
date_default_timezone_set('Europe/Budapest');

// Aktivitás követéséhez szükséges, amit a belépett felhasználó látni fog(Online/Offline)
// fetch_user.php-ban hívom meg az aktivitási állapot megjelenítése végett
function fetch_legutobbi_aktivitas($felhasznalo_id, $db_conn) {
    $query = "SELECT * FROM belepes_reszletek WHERE felhasznalo_id = '$felhasznalo_id' ORDER BY legutobbi_aktivitas DESC LIMIT 1";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    foreach ($result as $row) {
        return $row['legutobbi_aktivitas'];
    }
}

// Üzenet létrehozó függvény, id alapján kezeli, kitől származik az üzenet, kinek van címezve
function fetch_message($kitol_id, $kinek_id, $db_conn) {
    $query = "SELECT * FROM uzenetek WHERE  (kitol_id = '" . $kitol_id . "' AND kinek_id = '" . $kinek_id . "') OR (kitol_id = '" . $kinek_id . "' AND kinek_id = '" . $kitol_id . "')  ORDER BY idobelyeg DESC";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    $tabla = '<ul class="list-unstyled">';
    foreach ($result as $row) {
        $felhasznalo_nev = '';
        if ($row["kitol_id"] == $kitol_id) {
            // A küldött üzenet megjelenítése a belejentkezett személyében
            $felhasznalo_nev = '<b class="text-success">Te</b>';
        } else {
            $felhasznalo_nev = '<b class="text-danger">' . get_felhasznalo_nev($row['kitol_id'], $db_conn) . '</b>';
        }
        // Üzenet mellett a pontos idő mutatása
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

// fetch_user.php-ban a felhasználók nevét kezelő táblaoszlopban kerülnek kiíratásra a felhasználók
function get_felhasznalo_nev($felhasznalo_id, $db_conn) {
    $query = "SELECT felhasznalo_nev FROM belepesi_adatok WHERE felhasznalo_id = '$felhasznalo_id'";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    foreach ($result as $row) {
        return $row['felhasznalo_nev'];
    }
}

// Meghatározom a belépett felhasználót és a címzett felhasználót id alapján
// count változóban ellenőrzöm az olvasatlan üzenetek számát, melyeket a span jeleníti meg
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
