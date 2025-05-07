<?php
$host = 'localhost';
$dbname = 'memoriajatek';
$username = 'admin';
$password = 'memoria123';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Hiba a csatlakozásnál: " . $e->getMessage());
}
?>
