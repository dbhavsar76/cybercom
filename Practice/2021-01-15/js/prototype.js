// basic person constructor function
function Person(name, birthYear, job) {
    this.name = name;
    this.birthYear = birthYear;
    this.job = job;
}

// everything in prototype is shared between instances of Person
// in a sense, every Person object inherits every property of the prototype
Person.prototype.calcAge = function() {
    return 2021 - this.birthYear;
}
Person.prototype.hairColor = 'black';


var p1 = new Person('dhrv', 2000, 'trainee');
var p2 = new Person('jake', 1995, 'Actor')
console.log(p1);
console.log(p2);

// and when an object gets its own property of same name, it overrides the one from prototype
p2.hairColor = 'brown';

// after this p2 has its own hairColor property ( p2.hasOwnProperty('hairColor') return true )
// but p1 doesn't have its own it still borrows from the prototype

// so prototype can be used to give a shared default property to the objects, which
// later they can override with their own property of same name. This also includes methods

