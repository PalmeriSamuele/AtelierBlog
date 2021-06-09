
window.addEventListener("DOMContentLoaded", (event) => {
    var connect = document.getElementById('connect');
    var connected = document.getElementById('connected2');
    var notconnected = document.getElementById('notconnected');



    if (connect.innerHTML.trim() === "se connecter") {

        notconnected.style.display = "inline";
        connected.style.display = "none";



    }

    else {
        connected.style.display = "inline";
        notconnected.style.display = "none";
    }


});

