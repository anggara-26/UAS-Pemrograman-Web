const faqCards = document.querySelectorAll(".faq-card");

faqCards.forEach((faqCard) => {
  faqCard.addEventListener("click", () => {
    faqCard.classList.toggle("active");
  });
});
