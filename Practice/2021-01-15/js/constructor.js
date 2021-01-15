// can't be called before definition
// var mark = new Person1('Mark', 1995, 'Target');

// Constructor Function
var Person1 = function(name, birthYear, job) {
    this.name = name;
    this.birthYear = birthYear;
    this.job = job;
};

var john = new Person1('John', 1990, 'Teacher');
console.log(john);

// constructor function with arrow function
// var Person2 = (name, birthYear, job) => {
//     this.name = name;
//     this.birthYear = birthYear;
//     this.job = job;
// };

// var mark = new Person2('Mark', 1995, 'Target');
// console.log(mark);
    
// doesn't work with arrow functions
// i'll have to know more about arrow functions vs normal functions
// i did find the major difference between them its in todays documentation.

var mark = new Person3('Mark', 1995, 'Target');
console.log(mark);
// can be called before definition

function Person3(name, birthYear, job) {
    // making scope-safe constructor
    if (!(this instanceof Person3)) return new Person3(name, birthYear, job);
    
    this.name = name;
    this.birthYear = birthYear;
    this.job = job;
}

// calling without new
var mary = Person3('Mary', 1999, 'Swimming Instructor');
console.log(mary);
// my ide shows warning when calling without new keyword, but other's might not

// one-time constructor
var smith = new function(name='Smith') {
    this.name = name;
    this.birthYear = 1997;
    this.job = 'Smith';
}
console.log(smith);
console.log(new smith.constructor('Smith Jr.'));
// well they say one-time constructor but i can use them more than once...
// but i wouldn't want to do something like this
