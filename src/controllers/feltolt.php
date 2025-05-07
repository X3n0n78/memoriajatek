<?php
if ($_FILES['kep']['size'] > 2_000_000) {
    die("Túl nagy fájl!");
}
move_uploaded_file($_FILES['kep']['tmp_name'], 'kepek/'.uniqid().'.jpg');
?>