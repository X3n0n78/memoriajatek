<?php
session_start();
include_once __DIR__ . '/../config/dbconfig.php';


$hiba = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $felhasznalonev = $_POST['felhasznalonev'] ?? '';
    $jelszo = $_POST['jelszo'] ?? '';

    // Felhasználó keresése az adatbázisban
    $stmt = $conn->prepare("SELECT * FROM felhasznalok WHERE felhasznalonev = ?");
    $stmt->execute([$felhasznalonev]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($jelszo, $user['jelszo'])) {
        // Sikeres bejelentkezés, session beállítása
        $_SESSION['felhasznalo'] = [
            'id' => $user['id'],
            'felhasznalonev' => $user['felhasznalonev'],
            'email' => $user['email']
        ];
        header('Location: index.php');
        exit;
    } else {
        $hiba = 'Hibás felhasználónév vagy jelszó!';
    }
}
?>

<h2>Belépés</h2>
<?php if ($hiba): ?>
    <div style="color:red;"><?= $hiba ?></div>
<?php endif; ?>
<form method="post">
    <label>Felhasználónév: <input type="text" name="felhasznalonev" required></label><br>
    <label>Jelszó: <input type="password" name="jelszo" required></label><br>
    <button type="submit">Belépés</button>
</form>
<p>Még nincs fiókod? <a href="index.php?oldal=regisztracio">Regisztrálj itt!</a></p>
