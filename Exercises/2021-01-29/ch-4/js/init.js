class Person {
    constructor(name, email, dob) {
        this.name = name;
        this.email = email;
        this.dob = dob; // date of birth
    }

    // get json of persons array and recreate the array of objects
    static parsePersons(pstr) {
        let persons = [];
        let temp = JSON.parse(pstr);
        for (let p of temp) {
            persons.push(new Person(p.name, p.email, p.dob));
        }
        return persons;
    }
}


var persons;
refreshArray();

function refreshArray() {
    let pstr = localStorage.getItem('persons2');
    if (pstr) {
        persons = Person.parsePersons(pstr);
    } else {
        persons = [];
    }
}

