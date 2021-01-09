var markMass = 80; // prompt('Enter Mark's Mass(kg) : '); // kilograms
var markHeight = 1.2; // prompt('Enter Mark's Height(m) : '); // meters
var markBMI;

var johnMass = 100; // prompt('Enter John's Mass(kg) : '); // kilograms
var johnHeight = 1.35; // prompt('Enter John's Height(m) : '); // meters
var johnBMI;

markBMI = markMass / (markHeight * markHeight);
johnBMI = johnMass / (johnHeight * johnHeight);

var isMarkHigh/*yes*/ = markBMI > johnBMI;

console.log("Mark's BMI : ", markBMI);
console.log("John's BMI : ", johnBMI);
console.log("Mark's BMI is higher then Jonh's BMI : ", isMarkHigh);
