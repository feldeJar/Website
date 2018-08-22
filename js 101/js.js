var today;
var hourNow = today.getHours();

var greeting;
    if(hourNow >20){
        greeting = "Good Night";
    }
    else if(hourNow > 15){
        greeting = "Good afternoon";
    }
    else if(hourNow > 10){
        greeting = "Good moring";
    }
    else{
        greeting = "hello";
    }
document.write(greeting);