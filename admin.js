

const emailCards = document.querySelectorAll(".email-card");

emailCards.forEach(card => {
    card.addEventListener("click", function () {
    const email = card.getAttribute("data-email");

    const url = window.location.pathname + '?srt=azbycx1928&email=' + encodeURIComponent(email);
    window.location.href = url;
    });
});

