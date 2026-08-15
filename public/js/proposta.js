document.addEventListener("DOMContentLoaded", () => {
  const view = document.getElementById("view-propostas-freela");
  if (!view) return;

  const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

  const baseClasses = [
    "text-white", "px-4", "py-1", "rounded-full",
    "font-label-md", "text-label-md", "border", "border-background"
  ];

  function getSpanEstado(card) {
    return card.querySelector(".flex.justify-between.items-start span");
  }

  function isPendente(card) {
    const span = getSpanEstado(card);
    return span && span.textContent.trim().toLowerCase() === "pendente";
  }

  function setEstado(card, texto, bgClass) {
    const span = getSpanEstado(card);
    if (!span) return;

    span.className = "";
    span.classList.add(bgClass, ...baseClasses);
    span.textContent = texto;
  }

  view.addEventListener("click", async (e) => {
    const btn = e.target.closest("button");
    if (!btn) return;

    // Se por acaso estiver dentro de form/link, evita navegação/submit
    e.preventDefault();

    const card = btn.closest(".neo-card");
    if (!card) return;

    const aceitar = btn.classList.contains("js-aceitar");
    const rejeitar = btn.classList.contains("js-rejeitar");
    if (!aceitar && !rejeitar) return;

    if (!isPendente(card)) return;

    const url = btn.dataset.url;
    if (!url) {
      console.error("Faltou data-url no botão.");
      return;
    }

    // trava para não clicar duas vezes
    btn.disabled = true;

    try {
      const resp = await fetch(url, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrf,
          "Accept": "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify({}) // se precisar mandar algo, manda aqui
      });

      if (!resp.ok) {
        // Laravel pode retornar 419 (CSRF), 403, 500 etc.
        const txt = await resp.text();
        throw new Error(`Erro ${resp.status}: ${txt}`);
      }

      // Atualiza UI só depois de salvar no backend
      if (aceitar) setEstado(card, "Aceito", "bg-[#4CAF50]");
      if (rejeitar) setEstado(card, "Rejeitado", "bg-[#FF5252]");

      const divIcones = card.querySelector(".divDosIcones");
      if (divIcones) divIcones.classList.add("hidden");

    } catch (err) {
      console.error(err);
      btn.disabled = false; // libera de novo se falhou
      alert("Não foi possível atualizar a proposta. Tente novamente.");
    }
  });
});