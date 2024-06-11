let taps = 0;
const tapButton = document.getElementById('tapButton');
const tapCounter = document.getElementById('tapCounter');

tapButton.addEventListener('click', () => {
    taps++;
    tapCounter.textContent = taps;
});