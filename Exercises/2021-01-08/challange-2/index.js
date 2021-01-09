    // John's teams scores
    var jnMatch1, jnMatch2, jnMatch3, jnAvg;
    jnMatch1 = 111; // prompt('Enter John Match 1 Score : ');
    jnMatch2 = 120; // prompt('Enter John Match 2 Score : ');
    jnMatch3 = 102; // prompt('Enter John Match 3 Score : ');

    // Mike's teams score
    var mkMatch1, mkMatch2, mkMatch3, mkAvg;
    mkMatch1 = 116; // prompt('Enter Mike Match 1 Score : ');
    mkMatch2 = 94;  // prompt('Enter Mike Match 2 Score : ');
    mkMatch3 = 123; // prompt('Enter Mike Match 3 Score : ');

    jnAvg = (jnMatch1 + jnMatch2 + jnMatch3) / 3;
    mkAvg = (mkMatch1 + mkMatch2 + mkMatch3) / 3;

    console.log('John\'s Team Avg Score : ', jnAvg);
    console.log('Mike\'s Team Avg Score : ', mkAvg);
    if (jnAvg  == mkAvg)
        console.log('It\'s a Draw.')
    else if (jnAvg > mkAvg)
        console.log('Winner : John\'s Team.');
    else
        console.log('Winner : Mike\'s Team.');
