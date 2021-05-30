
var connect = document.getElementsByClassName('connect');
var connected = document.getElementById('connected');
var notconnected = document.getElementById('notconnected');


if (connect[0].innerHTML == 'se connecter') {

    notconnected.style.display = 'none';
    connected.style.display = 'inline';
}

else {
    connected.style.display = 'none';
    notconnected.style.display = 'inline';
}


