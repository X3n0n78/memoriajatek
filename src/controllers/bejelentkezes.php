<?php
if (password_verify($_POST['jelszo'], $adatbazis_jelszo)) {
    $_SESSION['felhasznalo'] = $felhasznalonev;
}
include_once __DIR__ . '/../config/dbconfig.php';

?>