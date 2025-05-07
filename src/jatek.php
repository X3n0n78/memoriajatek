<?php
const kepek = ['kep1.jpg', 'kep2.jpg', 'kep3.jpg', 'kep4.jpg'];
const jatekTer = document.getElementById('jatek-ter');
include_once __DIR__ . '/../config/dbconfig.php';


// Keverés és rács generálás
kepek.concat(kepek).sort(() => Math.random() - 0.5).forEach(kep => {
    const kartya = document.createElement('div');
    kartya.className = 'kartya';
    kartya.innerHTML = `<img src="hatter.jpg" data-kep="${kep}">`;
    kartya.addEventListener('click', kartyaKattintas);
    jatekTer.appendChild(kartya);
});
?>
