


window.addEventListener("DOMContentLoaded", (event) => {


    if (getCookie("theme") == "dark") {
        document.getElementById('change-theme').href = '/php_simple/resources/css/dark-mode.css';
        changeMode.checked = false;

    }
    else {
        document.getElementById('change-theme').href = '/php_simple/resources/css/light-mode.css';
        changeMode.checked= true;
    }

});


var changeMode = document.getElementById('dark-theme');


changeMode.addEventListener('click', () => {
    if (getCookie("theme") != "dark") {
        document.getElementById('change-theme').href = '/php_simple/resources/css/dark-mode.css'
        document.getElementById('checkbox').checked = false;
        document.cookie = "theme=dark ; path=/";
    }
    else {
        document.getElementById('change-theme').href = '/php_simple/resources/css/light-mode.css'
        document.cookie = "theme=light ; path=/";
        document.getElementById('checkbox').checked = true;
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
