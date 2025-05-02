

const emailCards = document.querySelectorAll(".email-card");

emailCards.forEach(card => {
    card.addEventListener("click", function () {
    const email = card.getAttribute("data-email");
    alert(email)
    // Redirect to message.php?email=example@gmail.com
    window.location.href = 'message.php?email=${email}';
    });
});

