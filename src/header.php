<?php
session_start();
?>
<nav>
    <a href="index.php?oldal=kezdolap">Főoldal</a>
    <a href="index.php?oldal=jatek">Játék</a>
    <!-- ... további menüpontok ... -->
    <?php if (isset($_SESSION['felhasznalo'])): ?>
        <a href="kilepes.php">Kilépés</a>
        <span>Bejelentkezett: <?= htmlspecialchars($_SESSION['felhasznalo']['felhasznalonev']) ?></span>
    <?php else: ?>
        <a href="index.php?oldal=belepes">Belépés</a>
    <?php endif; ?>
</nav>
