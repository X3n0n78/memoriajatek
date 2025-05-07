<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);
}
include 'dbconfig.php';
?>