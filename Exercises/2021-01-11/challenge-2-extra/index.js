// John's teams scores
var jnScores = [89, 120, 103];
var jnAvg;

// Mike's teams score
var mkScores = [116, 94, 123];
var mkAvg;

// Mary's teams scores
var mrScores = [97, 134, 105];
var mrAvg;

var average = (arr) => arr.reduce((a, b) => a + b)/arr.length;
jnAvg = average(jnScores);
mkAvg = average(mkScores);
mrAvg = average(mrScores);

console.log('John\'s Team Avg Score : ', jnAvg);
console.log('Mike\'s Team Avg Score : ', mkAvg);
console.log('Mary\'s Team Avg Score : ', mrAvg);

if (jnAvg == mkAvg && jnAvg == mrAvg) {
    console.log('All three teams tie for first place.');
}
else if (jnAvg >= mkAvg && jnAvg >= mrAvg) {
    if (jnAvg == mkAvg)
        console.log('John\'s and Mike\'s teams tie for first place.');
    else if (jnAvg == mrAvg)
        console.log('John\'s and Mary\'s teams tie for first place.');
    else
        console.log('John\'s team win with highest score.');
}
else if (mkAvg > jnAvg && mkAvg >= mrAvg) {
    if (mkAvg == mrAvg)
        console.log('Mike\'s and Mary\'s teams tie for first place.');
    else
        console.log('Mike\'s team win with highest score.');
}
else {
    console.log('Mary\'s team win with highest score.');
}