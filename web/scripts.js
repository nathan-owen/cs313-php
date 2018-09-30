// All Scripts Live Here

function isItHalloween() {
    var d = new Date();

    var date = d.getDate();
    var month = d.getMonth() + 1; //Get Month is weird. January = 0 December = 11

    if(date == 31 && month == 10) {
        setAnswer(true);
    }
    else {
        setAnswer(false);
    }
}

function isItChristmas() {
    var d = new Date();

    var date = d.getDate();
    var month = d.getMonth() + 1; //Get Month is weird. January = 0 December = 11

    if(date == 25 && month == 12) {
        setAnswer(true);
    }
    else {
        setAnswer(false);
    }
}

function whatDayIsIt() {
    var d = new Date();

    var answerItem = document.getElementById("answer");

    answerItem.innerHTML = d.toDateString();
    answerItem.className = "";
}


function setAnswer(answer) {
    if(answer == true){
        document.getElementById("answer").innerHTML = "Yes";
        document.getElementById("answer").className = "yes";
    } else {
        document.getElementById("answer").innerHTML = "No";
        document.getElementById("answer").className = "no";
    }
}