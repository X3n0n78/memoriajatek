<?php
include_once __DIR__ . '/../config/dbconfig.php';

$hiba = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csaladi_nev = $_POST['csaladi_nev'] ?? '';
    $utonev = $_POST['utonev'] ?? '';
    $felhasznalonev = $_POST['felhasznalonev'] ?? '';
    $email = $_POST['email'] ?? '';
    $jelszo = $_POST['jelszo'] ?? '';

    if ($csaladi_nev && $utonev && $felhasznalonev && $email && $jelszo) {
        // Ellenőrizd, hogy a felhasználónév vagy email már létezik-e
        $stmt = $conn->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ? OR email = ?");
        $stmt->execute([$felhasznalonev, $email]);
        if ($stmt->fetch()) {
            $hiba = "Ez a felhasználónév vagy email már foglalt!";
        } else {
            $jelszo_hash = password_hash($jelszo, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO felhasznalok (csaladi_nev, utonev, felhasznalonev, email, jelszo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$csaladi_nev, $utonev, $felhasznalonev, $email, $jelszo_hash]);
            echo "<div>Sikeres regisztráció! Jelentkezz be!</div>";
        }
    } else {
        $hiba = "Minden mező kitöltése kötelező!";
    }
}
?>

<h2>Regisztráció</h2>
<?php if ($hiba): ?>
    <div style="color:red;"><?= htmlspecialchars($hiba) ?></div>
<?php endif; ?>
<form method="post">
    <label>Családi név: <input type="text" name="csaladi_nev" required></label><br>
    <label>Utónév: <input type="text" name="utonev" required></label><br>
    <label>Felhasználónév: <input type="text" name="felhasznalonev" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Jelszó: <input type="password" name="jelszo" required></label><br>
    <button type="submit">Regisztráció</button>
</form>
