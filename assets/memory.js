
const images = [
    'assets/cherry.jpg', 'assets/chili.png', 'assets/pineapple.png', 'assets/lemon.png',
    'assets/apple.png', 'assets/banana.png', 'assets/grape.png', 'assets/pear.png'
];

let cards = [];
let firstCard = null, secondCard = null, lockBoard = false, attempts = 0, matchedPairs = 0;

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function createBoard() {
    const board = document.getElementById('game-board');
    board.innerHTML = '';
    attempts = 0;
    matchedPairs = 0;
    document.getElementById('attempts').textContent = attempts;

    // Duplázzuk a képeket, majd keverjük
    cards = images.concat(images);
    shuffle(cards);

    cards.forEach((img, idx) => {
        const card = document.createElement('div');
        card.className = 'card';
        card.dataset.img = img;
        card.addEventListener('click', flipCard);
        board.appendChild(card);
    });
}

function flipCard() {
    if (lockBoard || this.classList.contains('flipped') || this.classList.contains('matched')) return;

    this.classList.add('flipped');
    this.innerHTML = `<img src="${this.dataset.img}" alt="card">`;

    if (!firstCard) {
        firstCard = this;
        return;
    }
    secondCard = this;
    attempts++;
    document.getElementById('attempts').textContent = attempts;
    lockBoard = true;

    if (firstCard.dataset.img === secondCard.dataset.img) {
        firstCard.classList.add('matched');
        secondCard.classList.add('matched');
        matchedPairs++;
        resetTurn();
        if (matchedPairs === images.length) {
            setTimeout(() => alert('Gratulálok, nyertél!'), 500);
        }
    } else {
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            firstCard.innerHTML = '';
            secondCard.innerHTML = '';
            resetTurn();
        }, 1000);
    }
}

function resetTurn() {
    [firstCard, secondCard, lockBoard] = [null, null, false];
}

document.getElementById('restart-btn').addEventListener('click', createBoard);

// Indítás
document.addEventListener('DOMContentLoaded', createBoard);
