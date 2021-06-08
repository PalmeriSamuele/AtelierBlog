var changeMode = document.getElementById('checkbox');


console.log(changeMode);

changeMode.addEventListener('click',() => {
    document.body.classList.toggle('dark');
    document.cookie = "theme=dark ; path=/";
});