<?php
session_start();
include 'config.php';

$oldal = $_GET['oldal'] ?? 'kezdolap';

if (!isset($menu[$oldal]) || !$menu[$oldal]['lathato']) {
    $oldal = '404';
}

include 'header.php'; 
include $oldal . '.php'; 
include 'footer.php';
?>