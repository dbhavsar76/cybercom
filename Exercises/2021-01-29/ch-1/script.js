const Person = function(name, age) {
    this.name = name;
    this.age = age;
}

Person.prototype.greet = function() {
    return `Hello! My name is ${this.name}.`;
}

const p1 = new Person('John', 20);

const Teacher = function(name, age, subject) {
    Person.call(this, name, age);
    this.subject = subject;
}

Teacher.prototype = Object.create(Person.prototype);
Teacher.prototype.constructor = Teacher;
Teacher.prototype.greet = function() {
    return `Hello! My name is ${this.name}. I'm a Teacher and I teach ${this.subject}.`;
}

const t1 = new Teacher('Jane', 25, 'English');

console.log(p1);
console.log(t1);
console.log('Listing Properties of P1:');
console.log('------------');
const p1keys = Object.keys(p1);                 // with normal for loop enumeration
for (let i=0; i<p1keys.length; i++) {
    console.log(p1keys[i], ':', p1[p1keys[i]]);
}
console.log(' ');

console.log('Listing Properties of T1:');       // with for..in loop
console.log('------------');
for (const key in t1) {
    if (t1.hasOwnProperty(key)) {
        console.log(key, ':',t1[key]);
    }
}
