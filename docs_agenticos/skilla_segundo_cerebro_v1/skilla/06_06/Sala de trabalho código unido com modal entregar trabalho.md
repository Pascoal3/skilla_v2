
```


    <!-- Mobile TopAppBar (hidden on md) -->

    <header

      class="md:hidden fixed top-0 w-full z-50 bg-white border-b border-gray-200 flex justify-between items-center h-16 px-margin-mobile"

    >

      <div class="font-display-lg text-headline-md font-black text-primary-fixed">Skilla</div>

      <div class="flex gap-4">

        <span class="material-symbols-outlined text-black">info</span>

        <span class="material-symbols-outlined text-black">more_vert</span>

      </div>

    </header>

  

    <!-- Main Content Area -->

    <main

      class="flex-1 lg:ml-64 h-full flex flex-col bg-[#D4FF00] relative pt-16 md:pt-0 pb-[72px] lg:pb-0 overflow-hidden"

    >

      <!-- Chat Header -->

      <div

        class="bg-white border-b border-gray-200 px-margin-mobile md:px-gutter py-4 flex justify-between items-center shrink-0 shadow-sm z-20 rounded-b-xl lg:rounded-none"

      >

        <div class="flex items-center gap-4">

          <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-fixed hidden sm:block">

            <img

              alt="Client Logo"

              class="w-full h-full object-cover"

              src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3mnX26vKnjiE7lkgPOzM_-P8x_gLtdhDtE4diNxIzJIMUPkVYMUyAgSJ1mooqjvIT6Wonn8Z1YXlTB22X4UUTfKQDx-Yqxk35-8dHhsfGvxaC3iZf2ZoFtHEBjqNbxaPZJgyeDCxem8wUV-MckGB6o9g3DD5__hK_SV4OOxMoLzpq8CbymlDAEnj2QrELQFpFRxWdbEYxpZK0h6xVRgY-fijAPbErhvj3gphkeCcZIaaekpXNmpnk46tPZ_GdOpZ8Dbnusgplt0I"

            />

          </div>

          <div>

            <h1 class="font-headline-md text-headline-md text-black">Sala de trabalho — Logo Skilla</h1>

            <div class="flex items-center gap-2 mt-1">

              <span class="font-label-sm text-label-sm text-gray-500 uppercase tracking-wider">Contrato #1024</span>

              <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed"></span>

              <span class="font-label-sm text-label-sm text-primary-fixed font-bold">Status: Ativo</span>

            </div>

          </div>

        </div>

  

        <button

          class="hidden sm:flex px-4 py-2 bg-gray-50 border border-gray-200 text-black rounded-lg font-label-md text-label-md hover:border-primary-fixed transition-colors items-center gap-2"

        >

          <span class="material-symbols-outlined text-[18px]">visibility</span>

          Ver detalhes

        </button>

  

        <button class="sm:hidden p-2 text-gray-500 hover:text-primary-fixed">

          <span class="material-symbols-outlined">info</span>

        </button>

      </div>

  

      <!-- Chat Messages Area -->

      <div class="flex-1 overflow-y-auto bg-white p-margin-mobile md:p-gutter flex flex-col gap-6 relative">

        <div class="flex justify-center my-4">

          <div

            class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm"

          >

            O contrato foi iniciado. Pode usar esta sala para comunicar e enviar ficheiros.

          </div>

        </div>

  

        <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Client"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdsdrxNRELguNRZj1IJOZLygHNtSPVOgi8_ZOn-y4IAJOwfmHVOgkqbnYLILHPczmdjFaeFVkGoCeuimXarQp-jNI4jpQEi7BS42bFszr6a1SUMqjy5migHyRF47acCZAfTwj-NZbm6AD6PgoHzW8ZJPOl7CY7zokqiujQ4Vl42jeLt1j6ehPipnSZsO-gS9Ifl8eLLgwtxqhOZ1LW41bTrZzWpNVxaNSpBtNa4XPslv47OIYZroenTGJ8WsGiZxzNP6qPwF3IQWQ"

              />

            </div>

            <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">

              <p class="font-body-md text-body-md">

                Olá! Obrigado por aceitares o projeto. Estamos muito entusiasmados para ver as tuas ideias para o logo da

                Skilla.

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:00 AM</span>

        </div>

  

        <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2 flex-row-reverse">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Freelancer"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI"

              />

            </div>

            <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">

              <p class="font-body-md text-body-md">

                Olá! O prazer é meu. Já estive a ler o briefing. Têm alguma preferência de cor além do que está no

                documento?

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:15 AM</span>

        </div>

  

        <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Client"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMtEUukVwRHLJWA5VJMB_Z2OEDM67ml2iqohOuys-svJk8tZVdelRDaJULTvOOg0b09uYDnfHIOJrt2t-12khyF2esX0rUUL_JW6GpRkT2PuByURWoEUzSdlGi-geyI9Ij2VJgooVx3yw5EisDpkaE-oIzQ8F2Qimq7zaWYpL-MTaxbxSaX3sroKwzML6rQpdvI80i2nCEXkkoleLyixfrCncdLCOsnBVfYB9WSCzb4YuFPRVuCHhzcorTBK65jo3wW8_hAtzCtpE"

              />

            </div>

            <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">

              <p class="font-body-md text-body-md">

                Queremos algo que transmita 'energia' e 'eficiência'. Talvez explorar tons de verde ou amarelo néon, mas

                mantendo um ar profissional SaaS.

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:22 AM</span>

        </div>

  

        <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2 flex-row-reverse">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Freelancer"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb9jdD_yRthmEprVP0ea3a8-bww_hRnImKg7n83h3HhxGlMyegvdSlKyHybq31r6trs2NNkh2GhHRvq4Jj_4e_AJNVN2zGvMAk9HywKw68WCUzjJrzRJoOo72cScpBzB1MuhtpfLvFl-NyymlR76vcU3yar2CODAm2u6kv6G02j-vkD8bJDR3eGtWZ4BR2KndHT8pXJ1lruZ4EU0bROMPf-dYpvJtYEgPOh_N5tWgNHrFm2DRk-KYQc5ngF9BOWLakraXevaHXe88"

              />

            </div>

            <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">

              <p class="font-body-md text-body-md">

                Perfeito. 'Neo-Brutalism' misturado com 'High-End SaaS' parece o caminho. Vou preparar alguns rascunhos

                iniciais.

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:30 AM</span>

        </div>

  

        <div class="flex justify-center my-4">

          <div

            class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm"

          >

            Ficheiro anexado: 'skilla_brand_guidelines_v1.pdf'

          </div>

        </div>

  

        <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Client"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_7HpkQlvWrDJO81nsCR4JzInDcoNgIAYKbC4qYmXGcof3aZDBnoUy_Qy_87_BqBrc4doYgvlGQheL8QhDJcL81bg5SGhiVfIDuY_U7xvkZQ2oaiolthsRo5O69XePpsNXyWsPX_xmj-pIMqvaXQQOelFHiBSAUjgO0UD21Op62cYl8lKKuoWqKq7BqUNLOGPeHKDLTpJQxmz7VYqvnpHrpQhwBC0XRj6iaikikansYSgz0PpnPN4o2TQZ-RA0_ymdadsimmoAn0g"

              />

            </div>

            <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">

              <p class="font-body-md text-body-md">

                Acabei de enviar as guidelines antigas, apenas como referência do que NÃO queremos fazer. Ignora a paleta

                antiga.

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:35 AM</span>

        </div>

  

        <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">

          <div class="flex items-end gap-2 flex-row-reverse">

            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">

              <img

                alt="Freelancer"

                class="w-full h-full object-cover"

                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsEBlojcd2zurnGbBmWqrsITHv5CYOl1IMzIPbUmeIFpj-bJs8AAtlvpcqT-ir7Z5yWCqd2pgX0YD-p0IO37Xf5_-Q8fZbwheoFJA0gE2f9vtmcI7wv5vdoCdLMBO2arxTyrHQWFDNn5H9tiA0OY9aFylBv6C1zrGTBgjVnVNe8mjPnLE7jdodTm7PCr52sG_98dtnHE5SuIEvWYDYS120EDssyrrC_cY2hjRxWIXihz5QSNWrWMkePFAh-2ECB3SjJFxD1VnT3ag"

              />

            </div>

            <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">

              <p class="font-body-md text-body-md">

                Recebido. Vou focar-me no contraste alto. Em 48h envio as primeiras 3 propostas.

              </p>

            </div>

          </div>

          <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:40 AM</span>

        </div>

  

        <div class="h-10 shrink-0"></div>

      </div>

  

      <!-- Floating Action / Delivery Button -->

      <div class="absolute bottom-[80px] md:bottom-[90px] left-0 w-full flex justify-center px-4 pointer-events-none z-30">

        <button

          id="openDeliverModalBtn"

          class="pointer-events-auto bg-[#D4FF00] text-black border border-transparent shadow-lg font-label-md text-label-md font-bold py-3 px-8 rounded-full flex items-center gap-2 hover:bg-[#b4d400] transition-colors group"

        >

          <span class="material-symbols-outlined text-black group-hover:scale-110 transition-transform">task_alt</span>

          Entregar trabalho

        </button>

      </div>

  

      <!-- Chat Composer Footer -->

      <div class="bg-white border-t border-gray-200 p-3 md:p-4 shrink-0 z-20">

        <div

          class="max-w-4xl mx-auto flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-2 focus-within:border-primary-fixed transition-colors shadow-sm"

        >

          <button class="p-2 text-gray-500 hover:text-primary-fixed transition-colors rounded-lg hover:bg-gray-100">

            <span class="material-symbols-outlined">attach_file</span>

          </button>

          <input

            class="flex-1 bg-transparent border-none focus:ring-0 text-black font-body-md text-body-md placeholder:text-gray-400"

            placeholder="Escreve uma mensagem..."

            type="text"

          />

          <button

            class="w-10 h-10 bg-primary-fixed text-black rounded-lg flex items-center justify-center hover:opacity-90 transition-opacity"

          >

            <span class="material-symbols-outlined text-[20px]">send</span>

          </button>

        </div>

      </div>

    </main>

  

    <!-- Mobile BottomNavBar -->

    <nav

      class="fixed bottom-0 w-full lg:hidden rounded-t-xl bg-white border-t border-gray-200 shadow-[0px_-4px_20px_rgba(0,0,0,0.05)] z-50 flex justify-around items-center px-4 py-2"

    >

      <a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">

        <span class="material-symbols-outlined">home</span>

        <span class="font-label-sm text-label-sm mt-1">Home</span>

      </a>

  

      <a class="flex flex-col items-center justify-center bg-primary-fixed text-black rounded-xl p-2 scale-90 duration-150" href="#">

        <span class="material-symbols-outlined fill" style="font-variation-settings: 'FILL' 1;">chat_bubble</span>

        <span class="font-label-sm text-label-sm mt-1 font-bold">Chat</span>

      </a>

  

      <a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">

        <span class="material-symbols-outlined">task_alt</span>

        <span class="font-label-sm text-label-sm mt-1">Deliver</span>

      </a>

  

      <a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">

        <span class="material-symbols-outlined">person</span>

        <span class="font-label-sm text-label-sm mt-1">Me</span>

      </a>

    </nav>

  

    <!-- MODAL: Entregar trabalho (inicialmente escondido) -->

    <div id="deliverModal" class="fixed inset-0 bg-black/70 backdrop-blur-[4px] z-[60] hidden items-center justify-center p-4 overflow-y-auto">

      <!-- Modal Container -->

      <div class="bg-white text-black w-full max-w-[560px] my-8 rounded-modal border-[2px] border-black modal-shadow flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300 max-h-[calc(100vh-2rem)] sm:max-h-[calc(100vh-4rem)] min-h-0">

        <!-- Header -->

        <div class="px-8 pt-8 pb-6 flex justify-between items-start">

          <div>

            <h1 class="font-headline-md text-[26px] font-extrabold leading-tight tracking-tight">Entregar trabalho</h1>

            <p class="font-body-md text-slate-500 text-sm mt-1">Envie notas e anexos para concluir a entrega.</p>

          </div>

          <button

            id="closeDeliverModalBtn"

            class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors group"

            type="button"

            aria-label="Fechar"

          >

            <span class="material-symbols-outlined text-slate-900">close</span>

          </button>

        </div>

  

        <!-- Modal Content -->

        <div class="px-8 flex-1 min-h-0 overflow-y-auto custom-scrollbar space-y-8 pb-8">

          <div class="space-y-3">

            <label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">NOTAS DA ENTREGA (OPCIONAL)</label>

            <textarea

              class="w-full min-h-[120px] rounded-xl border-[2px] border-black p-4 font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400"

              placeholder="Descreva o que foi entregue, instruções de uso, credenciais de teste, próximos passos..."

            ></textarea>

            <p class="font-body-md text-slate-500 text-[13px]">Estas notas serão enviadas ao cliente.</p>

          </div>

  

          <div class="space-y-6">

            <div class="space-y-3">

              <label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">ANEXOS E/OU LINK</label>

              <div class="relative group cursor-pointer">

                <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" />

                <div

                  class="border-[2px] border-dashed border-black rounded-2xl p-8 flex flex-col items-center justify-center text-center bg-white group-hover:bg-slate-50 transition-all"

                >

                  <span class="material-symbols-outlined text-[40px] mb-3 text-slate-900" style="font-variation-settings: 'wght' 300;">

                    upload

                  </span>

                  <p class="font-headline-md text-base font-bold">Arraste ficheiros aqui ou clique para selecionar</p>

                  <p class="font-body-md text-slate-500 text-[13px] mt-1">PDF, ZIP, PNG, JPG (máx. 25MB)</p>

                </div>

              </div>

            </div>

  

            <div class="space-y-3">

              <div class="relative flex items-center">

                <span class="material-symbols-outlined absolute left-4 text-slate-400">link</span>

                <input

                  class="w-full h-[56px] pl-12 pr-4 rounded-xl border-[2px] border-black font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400"

                  placeholder="Cole um link (Google Drive, GitHub, Figma...)"

                  type="url"

                />

              </div>

              <p class="font-body-md text-slate-500 text-[13px]">Certifique-se de que o link está acessível ao cliente.</p>

            </div>

          </div>

        </div>

  

        <!-- Footer -->

        <div class="px-8 py-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">

          <button

            id="cancelDeliverModalBtn"

            class="px-6 py-3 rounded-xl border-[2px] border-black bg-white font-headline-md text-sm font-bold hover:bg-slate-50 active:scale-95 transition-all"

            type="button"

          >

            Cancelar

          </button>

          <button

            class="px-6 py-3 rounded-xl bg-black text-primary-container font-headline-md text-sm font-bold flex items-center gap-2 hover:brightness-125 active:scale-95 transition-all"

            type="button"

          >

            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check</span>

            Confirmar entrega

          </button>

        </div>

      </div>

    </div>

  

    <script>

      const modal = document.getElementById("deliverModal");

      const openBtn = document.getElementById("openDeliverModalBtn");

      const closeBtn = document.getElementById("closeDeliverModalBtn");

      const cancelBtn = document.getElementById("cancelDeliverModalBtn");

  

      function openModal() {

        modal.classList.remove("hidden");

        modal.classList.add("flex");

        modal.setAttribute("aria-hidden", "false");

        document.body.classList.add("overflow-hidden");

      }

  

      function closeModal() {

        modal.classList.add("hidden");

        modal.classList.remove("flex");

        modal.setAttribute("aria-hidden", "true");

        document.body.classList.remove("overflow-hidden");

      }

  

      openBtn.addEventListener("click", openModal);

      closeBtn.addEventListener("click", closeModal);

      cancelBtn.addEventListener("click", closeModal);

  

      // fechar ao clicar no backdrop

      modal.addEventListener("click", (e) => {

        if (e.target === modal) closeModal();

      });

  

      // fechar com ESC

      document.addEventListener("keydown", (e) => {

        if (e.key === "Escape" && !modal.classList.contains("hidden")) closeModal();

      });

    </script>

```
