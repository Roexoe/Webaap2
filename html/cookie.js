document.addEventListener("DOMContentLoaded", function() {
    const cookiePopup = document.getElementById("cookie-popup");
    const acceptButton = document.getElementById("accept-cookies");

    // Functie om de popup te tonen
    function showCookiePopup() {
        cookiePopup.style.display = "block";
    }

    // Functie om de popup te verbergen
    function hideCookiePopup() {
        cookiePopup.style.display = "none";
    }

    // Event listener voor de accepteer knop
    acceptButton.addEventListener("click", function() {
        hideCookiePopup();
        // Stel de timer in om de popup elke 2 minuten opnieuw te tonen
        setTimeout(showCookiePopup, 3000); // 120000 milliseconden = 2 minuten
    });

    // Toon de popup wanneer de pagina geladen is
    showCookiePopup();
});