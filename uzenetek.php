$uzenetek = $pdo->query("SELECT * FROM uzenetek ORDER BY datum DESC")->fetchAll();
foreach ($uzenetek as $uzenet) {
    echo "<div>{$uzenet['datum']}: {$uzenet['uzenet']}</div>";
}
