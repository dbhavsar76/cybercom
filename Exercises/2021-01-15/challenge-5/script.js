// we can use pure css for this that's the best way
// but since it is a JS challenge i tried it in js
// it's not the best but it works...

var elements = document.getElementsByClassName('tooltip');
var tooltip = elements[0].children[1];

elements[0].addEventListener('mouseover', (e) => {
    // tooltip.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
    tooltip.style.visibility = 'visible';
});

elements[0].addEventListener('mouseout', (e) => {
    tooltip.style.visibility = 'hidden';
});

// or maybe by popup, the challenge meant alert...
// idk, here's code for alert

elements[1].addEventListener('mouseover', (e) => {
    alert('Welcome to my site.');
});