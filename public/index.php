<?php

include_once __DIR__ . '/../config/dbconfig.php';
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../src/header.php';


session_start();


$oldal = $_GET['oldal'] ?? 'kezdolap';

if (!isset($menu[$oldal]) || !$menu[$oldal]['lathato']) {
    $oldal = '404';
}

include 'header.php'; 
include $oldal . '.php'; 
include 'footer.php';
?>