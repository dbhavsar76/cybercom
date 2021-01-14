var bills, tips, totals;

bills = [124, 48, 268];
tips = [];
totals = [];

for (let bill of bills) {
    tips.push(Number(calcTip(bill).toFixed(2)));
}

for (let i=0; i<bills.length; i++) {
    totals.push(bills[i] + tips[i]);
}

document.getElementById('tips').innerHTML = ` 1. $${tips[0]} <br>
                                              2. $${tips[1]} <br>
                                              3. $${tips[2]}`;

document.getElementById('totals').innerHTML = ` 1. $${totals[0]} <br>
                                                2. $${totals[1]} <br>
                                                3. $${totals[2]}`;

function calcTip(bill) {
    if (bill < 50) {
        return 0.20 * bill;
    } else if (bill <= 200) {
        return 0.15 * bill;
    } else {
        return 0.10 * bill;
    }
}