// popup.js
window.onload = function() {
    alert('Registratie succesvol!');
    var button = document.createElement('button');
    button.innerHTML = 'Terug naar inlogpagina';
    button.onclick = function() {
        window.location.href = 'inlog.php';
    };
    document.body.appendChild(button);
};