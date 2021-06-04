
window.addEventListener("DOMContentLoaded", (event) => {
    
    var connected = document.getElementById('connected2');
    var notconnected = document.getElementById('notconnected');

    console.log(connect.innerHTML);
    console.log(connected);
    console.log(notconnected);

    if (document.getElementById('connect').innerHTML.trim() === "se connecter") {
        console.log('salut');

        document.getElementById('notconnected').style.display = "inline";
        document.getElementById('connected2').style.display = "none";

    

    }

    else {
        document.getElementById('connected2').style.display = "inline";
        document.getElementById('notconnected').style.display = "none";
    }

});