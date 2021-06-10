


window.addEventListener("DOMContentLoaded", (event) => {


    if (getCookie("theme") === "dark") {
        document.getElementById('change-theme').href = '/php_simple/resources/css/dark-mode.css';
        document.getElementById('dark-theme').checked = true;

    }
    else {
        document.getElementById('change-theme').href = '/php_simple/resources/css/light-mode.css';
        document.getElementById('dark-theme').checked = false;
  
    }

});


var changeMode = document.getElementById('dark-theme');


changeMode.addEventListener('click', () => {
    if (getCookie("theme") != "dark") {
        document.getElementById('change-theme').href = '/php_simple/resources/css/dark-mode.css';

        document.cookie = "theme=dark ; path=/";
    }
    else {
        document.getElementById('change-theme').href = '/php_simple/resources/css/light-mode.css';
        document.cookie = "theme=light ; path=/";

    }

});


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
