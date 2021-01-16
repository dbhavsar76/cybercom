var john = {
    name: 'John',
    age: 26,
    job: 'Teacher',
    present: function(style, timeOfDay) {
        if (style === 'formal') {
            console.log(`Good ${timeOfDay}, Ladies and Gentlemen! I'm ${this.name}, I'm a ${this.job} and I'm ${this.age} years old.`);
        } else if (style === 'friendly') {
            console.log(`Hey, Good ${timeOfDay}, I'm ${this.name}, I'm a ${this.job} and I'm ${this.age} years old.`);
        }},
};

var emily = {
    name: 'Emily',
    age: 23,
    job: 'Designer'
};

john.present('formal', 'morning');

// calling john's method for emily
john.present.call(emily, 'friendly', 'evening');

// with apply method
john.present.apply(emily, ['friendly', 'afternoon']);

// binding the method with preset arguments
var johnFriendly = john.present.bind(john, 'friendly');
var emilyFormal = john.present.bind(emily, 'formal');

johnFriendly('evening');
emilyFormal('afternoon');