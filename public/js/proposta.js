document.addEventListener("DOMContentLoaded", () => {
  const view = document.getElementById("view-propostas-freela");
  if (!view) return;

  const baseClasses = [
    "text-white", "px-4", "py-1", "rounded-full",
    "font-label-md", "text-label-md", "border", "border-background"
  ];

  function getSpanEstado(card) {
    // no teu HTML: primeiro .flex.justify-between... contém o span "Pendente"
    return card.querySelector(".flex.justify-between.items-start span");
  }

  function isPendente(card) {
    const span = getSpanEstado(card);
    return span && span.textContent.trim().toLowerCase() === "pendente";
  }

  function setEstado(card, texto, bgClass) {
    const span = getSpanEstado(card);
    if (!span) return;

    span.className = ""; // zera classes antigas
    span.classList.add(bgClass, ...baseClasses);
    span.textContent = texto;
  }

  view.addEventListener("click", (e) => {
    // garante que pega clique no botão mesmo clicando no <span> do ícone
    const btn = e.target.closest("button");
    if (!btn) return;

    const card = btn.closest(".neo-card");
    if (!card) return;

    const aceitar = btn.classList.contains("js-aceitar");
    const rejeitar = btn.classList.contains("js-rejeitar");
    if (!aceitar && !rejeitar) return;

    if (!isPendente(card)) return;

    if (aceitar) setEstado(card, "Aceito", "bg-[#4CAF50]");
    if (rejeitar) setEstado(card, "Rejeitado", "bg-[#FF5252]");

    // esconde a div dos ícones (no teu HTML ela tem a classe divDosIcones)
    const divIcones = card.querySelector(".divDosIcones");
    if (divIcones) divIcones.classList.add("hidden");
    // ou: divIcones.style.display = "none";
  });
});