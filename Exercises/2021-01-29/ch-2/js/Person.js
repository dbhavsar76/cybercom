class Person {
    constructor(name, age, email, number) {
        this.name = name;
        this.age = age;
        this.email = email;
        this.number = number;
    }

    // get json of persons array and recreate the array of objects
    static parsePersons(pstr) {
        let persons = [];
        let temp = JSON.parse(pstr);
        for (let p of temp) {
            persons.push(new Person(p.name, p.age, p.email, p.number));
        }
        return persons;
    }
}
