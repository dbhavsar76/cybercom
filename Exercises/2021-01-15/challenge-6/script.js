var p = document.getElementById('series');

var a = 1, b = 1, c;

p.innerHTML = '1, 1';
for (var i = 0; i < 20; i++) {
    c = a + b;
    p.innerHTML += `, ${c}`;
    a = b;
    b = c;
}
p.innerHTML += ', ...';