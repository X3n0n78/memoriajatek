<?php
include_once __DIR__ . '/../config/dbconfig.php';

?>

<form action="feltolt.php" method="post" enctype="multipart/form-data">
    <input type="file" name="kep" accept="image/*">
    
    <button <?=!isset($_SESSION['felhasznalo']) ? 'disabled' : ''?>>Feltöltés</button>
</form>
