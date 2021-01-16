// function to get percentage
//
// outer function takes the total amount of something
// and returns a function, which when passed current amout
// returns the percentage of the 'something'

function percentage(total) {
    var multiplier = 100/total;
    return function(current) {
        return `${current} is ${current * multiplier}% of ${total}`;
    }
}

var outOf100 = percentage(100);
var outOf250 = percentage(250);

console.log(outOf100(70));
console.log(outOf250(70));

console.log(outOf100(130));
console.log(outOf250(130));
