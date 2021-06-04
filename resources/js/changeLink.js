var epinglerLink = document.getElementById('pinneLink')



function changeClassDePinne() { 
    document.getElementById('pinneLink').className = "far fa-star";
    document.getElementById('pinneLink').onClick = "changeClassPinne()";

}

function changeClassPinne() {
    document.getElementById('pinneLink').className = "far fa-star";
    document.getElementById('pinneLink').onClick = "changeClassDePinne()";
}