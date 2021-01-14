var newbtn = document.getElementById('btn-new');
var rollbtn = document.getElementById('btn-roll');
var holdbtn = document.getElementById('btn-hold');
var dice = document.getElementById('dice');
var scores = [0, 0];
var currentScore = 0;
var activePlayer = 0;

// reset the board when page loads
window.addEventListener('load', (e) => {
    dice.style.display = 'none';
    resetBoard();
});

// reset the board on new game
newbtn.addEventListener('click', (e) => {
    rollbtn.disabled = false;
    holdbtn.disabled = false;
    resetBoard();
});

// when roll dice is clicked
rollbtn.addEventListener('click', (e) => {
    // game logic
    var roll = Math.floor(Math.random() * 6) + 1;
    if (roll == 1) {
        switchPlayer();
    } else {
        currentScore += roll;
    }
    
    // update screen
    document.getElementById(`current-${activePlayer}`).textContent = currentScore;
    dice.style.display = 'block';
    dice.src = `img/dice-${roll}.png`;
});

// when hold button is pressed
holdbtn.addEventListener('click', (e) => {
    scores[activePlayer] += currentScore;
    document.getElementById(`score-${activePlayer}`).textContent = scores[activePlayer];

    if (scores[activePlayer] >= 100) {
        getActivePanel().classList.add('winner');
        getActivePanel().classList.remove('active');
        dice.style.display = 'none';
        rollbtn.disabled = true;
        holdbtn.disabled = true;
        return;
    }

    switchPlayer();
});

// function to reset all values back to zero
function resetBoard() {
    if (activePlayer) getActivePanel().classList.remove('active');
    scores = [0, 0];
    currentScore = 0;
    activePlayer = 0;
    getActivePanel().classList.add('active');
    document.getElementById('score-0').textContent = 0;
    document.getElementById('score-1').textContent = 0;
    document.getElementById('current-0').textContent = 0;
    document.getElementById('current-1').textContent = 0;
    let winner = document.getElementsByClassName('winner')[0];
    if (winner) winner.classList.remove('winner');

}

function switchPlayer() {
    currentScore = 0;
    document.getElementById(`current-${activePlayer}`).textContent = currentScore;
    getActivePanel().classList.remove('active');
    activePlayer = 1 - activePlayer;
    getActivePanel().classList.add('active');
}

function getActivePanel() {
    return document.getElementsByClassName(`player-${activePlayer}-panel`)[0];
}