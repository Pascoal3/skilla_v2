document.addEventListener("DOMContentLoaded", () => {
  const view = document.getElementById("view-propostas-freela");
  if (!view) return;

  const baseClasses = [
    "text-white", "px-4", "py-1", "rounded-full",
    "font-label-md", "text-label-md", "border", "border-background"
  ];

  function getSpanEstado(card) {
    // span do estado fica no topo do card, no header flex justify-between
    return card.querySelector(".flex.justify-between span");
  }

  function isPendente(card) {
    const span = getSpanEstado(card);
    return span && span.textContent.trim().toLowerCase() === "pendente";
  }

  function setEstado(card, texto, bgClass) {
    const spanEstado = getSpanEstado(card);
    if (!spanEstado) return;

    spanEstado.className = "";
    spanEstado.classList.add(bgClass, ...baseClasses);
    spanEstado.textContent = texto;
  }

  view.addEventListener("click", (e) => {
    // detecta clique em qualquer um dos botões (mesmo clicando no <span> dentro)
    const btn = e.target.closest("button");
    if (!btn) return;

    const card = btn.closest(".neo-card");
    if (!card) return;

    // garante que é um dos botões de ação (check/cancel)
    const icon = btn.querySelector(".material-symbols-outlined");
    const iconName = icon?.textContent?.trim();

    const isAceitar = iconName === "check_circle";
    const isRejeitar = iconName === "cancel";
    if (!isAceitar && !isRejeitar) return;

    // só atua se estiver pendente
    if (!isPendente(card)) return;

    // muda estado
    if (isAceitar) setEstado(card, "Aceito", "bg-[#4CAF50]");
    if (isRejeitar) setEstado(card, "Rejeitado", "bg-[#FF5252]");

    // ESCONDE A DIV DOS BOTÕES: normalmente é o pai direto do botão
    const divIcones = btn.parentElement; // <div class="flex justify-end gap-4 mt-8">
    if (divIcones) {
      divIcones.classList.add("hidden"); // Tailwind
      // alternativa: divIcones.style.display = "none";
    } else {
      console.log("Não achei a div dos ícones para esconder.");
    }
  });
});