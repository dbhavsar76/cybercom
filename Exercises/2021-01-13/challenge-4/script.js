var john, mark;

john = {
    name: 'John',  // full name
    mass: 80,      // kilograms
    height: 1.2,   // meters
    calcBMI : function() {              // () => {} doesn't work here.
        this.bmi = this.mass / (this.height * this.height);
        return this.bmi;
    },
};

mark = {
    name: 'Mark',
    mass: 95,
    height: 1.11,
    calcBMI: john.calcBMI,
};

john.calcBMI();
mark.calcBMI();

if (john.bmi == mark.bmi) {
    console.log('They have the same BMI.');
} else if (john.bmi > mark.bmi) {
    console.log('John\'s BMI is higher than Mark\'s.');
} else {
    console.log('Mark\'s BMI is higher than John\'s.');
}

document.getElementById('john-info').innerHTML = `Name : ${john.name} <br>
                                                  Mass : ${john.mass} <br>
                                                  Height : ${john.height} <br>
                                                  BMI : ${john.bmi}`;

document.getElementById('mark-info').innerHTML = `Name : ${mark.name} <br>
                                                  Mass : ${mark.mass} <br>
                                                  Height : ${mark.height} <br>
                                                  BMI : ${mark.bmi}`;