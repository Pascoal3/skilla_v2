// public/js/mensagens-sala.js
(function () {
  // evita duplicar listeners se a view for renderizada mais do que 1x
  let initialized = false;

  function escapeHtml(s) {
    return String(s)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  window.initMensagensSala = function initMensagensSala() {
    const view = document.getElementById("view-mensagens-sala");
    if (!view) return false;

    // se esta view já foi inicializada, não reinicializa
    if (initialized) return true;

    // IMPORTANTE: adiciona id="chat-messages" na tua Chat Messages Area (recomendado)
    const messages =
      view.querySelector("#chat-messages") ||
      view.querySelector("main div.overflow-y-auto"); // fallback caso não metas o id

    const inputFile = view.querySelector("#deliverFile");
    const sendBtn = view.querySelector("#chat-send-btn");
    const chatInput = view.querySelector("#chat-input");

    if (!messages || !inputFile || !sendBtn || !chatInput) return false;

    let ficheiroSelecionado = null;

    inputFile.addEventListener("change", (e) => {
      ficheiroSelecionado = e.target.files?.[0] ?? null;

      // opcional: se quiseres mostrar um "preview" imediato, podes fazer aqui
      // (por enquanto, só vamos inserir quando clicar Enviar)
    });

    function appendMensagemFicheiro(file) {
      const wrapper = document.createElement("div");
      wrapper.className = "flex justify-center my-4";

      const bubble = document.createElement("div");
      bubble.className =
        "bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm";

      // textContent já é seguro, mas mantive escapeHtml caso queiras usar innerHTML no futuro
      bubble.textContent = `Ficheiro anexado: '${file.name}'`;

      wrapper.appendChild(bubble);
      messages.appendChild(wrapper);

      messages.scrollTop = messages.scrollHeight;
    }

    function appendMensagemTexto(texto) {
      const wrapper = document.createElement("div");
      wrapper.className =
        "flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]";

      const hhmm = new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });

      wrapper.innerHTML = `
        <div class="flex items-end gap-2 flex-row-reverse">
          <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
            <p class="font-body-md text-body-md">${escapeHtml(texto)}</p>
          </div>
        </div>
        <span class="font-label-sm text-label-sm text-gray-500 mr-10">${hhmm}</span>
      `;

      messages.appendChild(wrapper);
      messages.scrollTop = messages.scrollHeight;
    }

    sendBtn.addEventListener("click", (e) => {
      e.preventDefault();

      const texto = chatInput.value.trim();

      // se não tiver nada, não faz nada
      if (!texto && !ficheiroSelecionado) return;

      if (texto) {
        appendMensagemTexto(texto);
        chatInput.value = "";
      }

      if (ficheiroSelecionado) {
        appendMensagemFicheiro(ficheiroSelecionado);

        // limpar para permitir escolher o mesmo ficheiro novamente
        inputFile.value = "";
        ficheiroSelecionado = null;
      }
    });

    initialized = true;
    return true;
  };

  // se a view já estiver no DOM no load normal (não SPA), inicializa
  document.addEventListener("DOMContentLoaded", () => {
    window.initMensagensSala?.();
  });
})();