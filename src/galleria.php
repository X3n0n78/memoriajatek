<?php
session_start();
include_once __DIR__ . '/../config/dbconfig.php';

$hiba = '';
$siker = '';

if (isset($_SESSION['felhasznalo']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['kep']) && $_FILES['kep']['error'] === UPLOAD_ERR_OK) {
        $fajlnev = $_FILES['kep']['name'];
        $tmp = $_FILES['kep']['tmp_name'];
        $kiterj = strtolower(pathinfo($fajlnev, PATHINFO_EXTENSION));
        $engedelyezett = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($kiterj, $engedelyezett) && $_FILES['kep']['size'] <= 2*1024*1024) {
            $ujnev = uniqid() . '.' . $kiterj;
            $cel = __DIR__ . '/../uploads/' . $ujnev;
            if (move_uploaded_file($tmp, $cel)) {
                $feltolto_id = $_SESSION['felhasznalo']['id'];
                $stmt = $conn->prepare("INSERT INTO kepek (fajlnev, feltolto_id) VALUES (?, ?)");
                $stmt->execute([$ujnev, $feltolto_id]);
                $siker = "Sikeres feltöltés!";
            } else {
                $hiba = "Hiba a fájl mentésekor!";
            }
        } else {
            $hiba = "Csak JPG, JPEG, PNG, GIF képeket tölthetsz fel 2MB méretig!";
        }
    } else {
        $hiba = "Nem választottál ki képet!";
    }
}
?>

<h2>Képgaléria</h2>

<?php if (isset($_SESSION['felhasznalo'])): ?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="kep" accept="image/*" required>
        <button type="submit">Kép feltöltése</button>
    </form>
<?php else: ?>
    <div>Csak bejelentkezett felhasználók tölthetnek fel képet.</div>
<?php endif; ?>

<?php if ($hiba): ?><div style="color:red;"><?= $hiba ?></div><?php endif; ?>
<?php if ($siker): ?><div style="color:green;"><?= $siker ?></div><?php endif; ?>

<div class="gallery">
<?php
// Képek megjelenítése
$stmt = $conn->query("SELECT * FROM kepek ORDER BY feltoltve DESC");
while ($kep = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="gallery-item">';
    echo '<img src="uploads/' . htmlspecialchars($kep['fajlnev']) . '" width="180" height="180">';
    echo '</div>';
}
?>
</div>
