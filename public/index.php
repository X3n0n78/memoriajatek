<?php
session_start();

include_once __DIR__ . '/../config/dbconfig.php';
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../src/header.php';

$oldal = $_GET['oldal'] ?? 'kezdolap';

if (!isset($menu[$oldal]) || !$menu[$oldal]['lathato']) {
    $oldal = '404';
}
?>
<!-- HTML rész kezdete -->
<link rel="stylesheet" type="text/css" href="assets/style.css">

<?php
include_once __DIR__ . '/../src/' . $oldal . '.php';
include_once __DIR__ . '/../src/footer.php';
?>
