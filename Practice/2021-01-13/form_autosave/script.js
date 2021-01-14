var txtField = document.getElementById('txt');
var clrbtn = document.getElementById('clr');

// check for saved values when page loads
window.addEventListener('load', (event) => {
    var text = localStorage.getItem('text');
    if (text) {
        txtField.value = text;
    }
});

// save value whenever input changes
txtField.addEventListener('input', (event) => {
    localStorage.setItem('text', txtField.value);
});

// clear storage when button is clicked
clrbtn.addEventListener('click', (event) => {
    txtField.value = '';
    localStorage.clear();
});

// don't submit form on button click