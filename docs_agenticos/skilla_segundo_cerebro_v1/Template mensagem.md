
```

templates.mensagens = `
<div id="view-mensagens-inbox" class="flex min-h-screen bg-[#D4FF00] text-black">

  <div class="max-w-4xl mx-auto w-full">

  

    <!-- Header Section -->

    <div class="flex justify-between items-end mb-8">

      <div>

        <h2 class="text-headline-lg font-headline-lg text-surface-container-lowest tracking-tight mb-1">Mensagens</h2>

        <p class="text-body-md font-body-md text-surface-container">Salas de trabalho vinculadas a contratos</p>

      </div>

      <div class="flex gap-3">

        <button class="bg-surface-container-lowest text-primary-container p-2 rounded-lg flex items-center justify-center hover:bg-surface-container transition-colors">

          <span class="material-symbols-outlined text-[20px]">more_horiz</span>

        </button>

      </div>

    </div>

  

    <!-- Search Input -->

    <div class="mb-8 relative group">

      <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-surface-variant group-focus-within:text-surface-container-lowest transition-colors">search</span>

      <input class="w-full bg-tertiary text-on-tertiary border border-transparent focus:border-surface-container-lowest rounded-xl py-4 pl-12 pr-4 text-body-md font-body-md shadow-sm outline-none transition-all placeholder:text-surface-variant"

             placeholder="Pesquisar conversas" type="text"/>

    </div>

  

    <!-- Inbox List -->

    <div class="flex flex-col gap-3">

  

      <!-- Unread Item 1 -->

      <div data-open-chat class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">

        <div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>

        <img class="w-12 h-12 rounded-full object-cover bg-secondary"

             alt="Avatar"

             src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8IpAPjEGC61SjgTvvLluR4_zqfrAtVfAG1nLoA4Zfx42cFBApbVfnCNatWg3ZgQ0Jy8EishspWdM6L54qGXtImKfZ4cAZgqNARagAMjsXuDzjs5s0UknIkMd8YEcZitS42-zQT0iImQOmju6A4mMNUhZxtlKyVqIeamyLUd4xbTGqpD0JfTOLgJkG8RytvVO78wDhUJ2DQZRZFdKCi8T25VinDqtC4RvyqDfOm2dKaKtGUraovX8BShqlw66lqyfhBMTq7PA27tw"/>

        <div class="flex-1 min-w-0">

          <h3 class="text-body-lg font-body-lg font-bold text-on-tertiary truncate">Sala de trabalho — Logo Skilla</h3>

          <p class="text-body-md font-body-md text-surface-variant truncate font-semibold">Enviei as primeiras opções do logotipo. Pode validar?</p>

        </div>

        <div class="flex flex-col items-end gap-1 shrink-0">

          <span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">12:45</span>

          <span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[24px] text-center">3</span>

        </div>

      </div>

  

      <!-- Unread Item 2 -->

      <div data-open-chat class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">

        <div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>

        <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container shrink-0">

          <span class="material-symbols-outlined">storefront</span>

        </div>

        <div class="flex-1 min-w-0">

          <h3 class="text-body-lg font-body-lg font-bold text-on-tertiary truncate">Website para Restaurante</h3>

          <p class="text-body-md font-body-md text-surface-variant truncate font-semibold">Os arquivos do Figma foram atualizados com as novas fotos.</p>

        </div>

        <div class="flex flex-col items-end gap-1 shrink-0">

          <span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">09:30</span>

          <span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[24px] text-center">1</span>

        </div>

      </div>

  

      <!-- Read Item 1 -->

      <div data-open-chat class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">

        <img class="w-12 h-12 rounded-full object-cover bg-secondary"

             alt="Avatar"

             src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9p5NtQ7f1wLUB5hoOGxrkk54JWkNOfzMOuEnGvgLaR7mdRj6Gb1K6xhI5rUri7CGqnrkPi8fS2eqGVhRGW5BLPQcBFh7VLnFGgK_w3_I78Tf_Qrk63_0Kz-MQMDu1XDzIUn32k7tsQuVVbKOBj9lDaI0bq3uQnk5MzDQYDFEVAtRCgfiolFx9NZPS7kATHEoODg-qEOBcyRhgX4vjp9VLNnFcSHuZL4cF77YCcaNMW_Bq-QbYaTbaCtUjBhkfpq6qPzAMoRLgo5M"/>

        <div class="flex-1 min-w-0">

          <h3 class="text-body-lg font-body-lg text-on-tertiary truncate">Identidade Visual Barber Shop</h3>

          <p class="text-body-md font-body-md text-surface-variant truncate">Tudo certo. O pagamento da primeira parcela foi liberado.</p>

        </div>

        <div class="flex flex-col items-end gap-1 shrink-0">

          <span class="text-label-sm font-label-sm text-surface-variant">Ontem</span>

        </div>

      </div>

  

      <!-- Read Item 2 -->

      <div data-open-chat class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">

        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">

          <span class="material-symbols-outlined">smartphone</span>

        </div>

        <div class="flex-1 min-w-0">

          <h3 class="text-body-lg font-body-lg text-on-tertiary truncate">Landing Page para App</h3>

          <p class="text-body-md font-body-md text-surface-variant truncate">Perfeito, aguardo os próximos passos.</p>

        </div>

        <div class="flex flex-col items-end gap-1 shrink-0">

          <span class="text-label-sm font-label-sm text-surface-variant">Segunda</span>

        </div>

      </div>

  

      <!-- Read Item 3 -->

      <div data-open-chat class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">

        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">

          <span class="material-symbols-outlined">shopping_cart</span>

        </div>

        <div class="flex-1 min-w-0">

          <h3 class="text-body-lg font-body-lg text-on-tertiary truncate">E-commerce Simples</h3>

          <p class="text-body-md font-body-md text-surface-variant truncate">Projeto finalizado e arquivado.</p>

        </div>

        <div class="flex flex-col items-end gap-1 shrink-0">

          <span class="text-label-sm font-label-sm text-surface-variant">12 Mar</span>

        </div>

      </div>

  

    </div>

  </div>
  </div>

`;








```

templates.carteira_extrato_creditos = `

            <div id="view-carteira-extrato-creditos" class="flex min-h-screen bg-[#D4FF00] text-black">

            <main class="flex-1 pb-24 md:pb-8">

                <div class="mt-10 max-w-[640px] mx-auto px-4 md:px-0">

  

                <!-- Breadcrumb + voltar -->

                <div class="flex items-center justify-between gap-3 mb-8">

                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">

                    <a class="hover:underline" href="#carteira">Carteira</a> &gt;

                    <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;

                    <span>Extrato de créditos</span>

                    </div>

  

                </div>

  

                <!-- Balance Card -->

                <section class="mb-8">

                    <div class="bg-white border border-black/10 rounded-2xl p-8 relative overflow-hidden group hover:border-black/30 transition-all duration-300 shadow-sm">

                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#D4FF00]/20 blur-[60px]"></div>

  

                    <div class="flex items-center gap-4 mb-4">

                        <div class="w-12 h-12 bg-black/5 rounded-xl flex items-center justify-center">

                        <span class="material-symbols-outlined text-[#F59E0B]" style="font-variation-settings: 'FILL' 1;">stars</span>

                        </div>

                        <h3 class="text-[16px] leading-[24px] text-gray-600" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Créditos disponíveis</h3>

                    </div>

  

                    <div class="flex items-baseline gap-2">

                        <span class="text-[56px] font-bold text-black leading-none" style="font-family: Sora, ui-sans-serif, system-ui;">30</span>

                        <span class="text-[18px] leading-[28px] text-gray-600" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">créditos</span>

                    </div>

  

                    <div class="mt-6 flex gap-3">

                        <button data-go-add-creditos class="flex-1 py-3 bg-black text-[#D4FF00] text-[14px] leading-[20px] font-bold rounded-lg hover:opacity-90 active:scale-95 transition-all"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">

                        Adicionar créditos

                        </button>

  

                        <button class="px-4 py-3 border border-gray-300 text-black text-[14px] leading-[20px] rounded-lg hover:bg-gray-100 transition-all"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">

                        Como funciona?

                        </button>

                    </div>

                    </div>

                </section>

  

                <!-- Filters Section -->

                <section class="mb-8 space-y-4">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                    <div class="relative inline-block w-full md:w-auto">

                        <select class="appearance-none w-full md:w-56 bg-white border border-gray-300 text-black text-[14px] leading-[20px] px-4 py-2.5 rounded-xl focus:ring-1 focus:ring-black outline-none cursor-pointer"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">

                        <option>Últimos 30 dias</option>

                        <option>Últimos 7 dias</option>

                        <option>Mês atual</option>

                        </select>

                        <span class="material-symbols-outlined absolute right-3 top-2.5 text-gray-600 pointer-events-none">expand_more</span>

                    </div>

  

                    <div class="flex flex-wrap gap-2">

                        <button class="px-4 py-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-emerald-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-emerald-500/20 transition-all"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                        Compra

                        </button>

  

                        <button class="px-4 py-2 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-blue-500/20 transition-all"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">

                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                        Proposta

                        </button>

  

                        <button class="px-4 py-2 rounded-full border border-amber-500/30 bg-amber-500/10 text-amber-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-amber-500/20 transition-all"

                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">

                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                        Destaque

                        </button>

                    </div>

                    </div>

                </section>

  

                <!-- Transaction List -->

                <section class="space-y-6">

                    <!-- Group: Hoje -->

                    <div>

                    <h4 class="text-[14px] leading-[20px] text-gray-600 px-2 mb-3" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje</h4>

                    <div class="space-y-3">

                        <!-- Transaction Item: Outflow -->

                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-600">

                            <span class="material-symbols-outlined">send</span>

                            </div>

                            <div>

                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Proposta #54321</h5>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje, 10:15 • Proposta enviada</p>

                            </div>

                        </div>

                        <div class="text-right">

                            <span class="text-[16px] leading-[24px] font-bold text-[#DC2626]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">- 2</span>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 20</p>

                        </div>

                        </div>

  

                        <!-- Transaction Item: Highlight -->

                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-600">

                            <span class="material-symbols-outlined">bolt</span>

                            </div>

                            <div>

                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Upgrade: Destaque Topo</h5>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje, 08:30 • Projeto: App Delivery</p>

                            </div>

                        </div>

                        <div class="text-right">

                            <span class="text-[16px] leading-[24px] font-bold text-[#DC2626]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">- 5</span>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 22</p>

                        </div>

                        </div>

                    </div>

                    </div>

  

                    <!-- Group: Ontem -->

                    <div>

                    <h4 class="text-[14px] leading-[20px] text-gray-600 px-2 mb-3" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Ontem</h4>

                    <div class="space-y-3">

                        <!-- Transaction Item: Inflow -->

                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-600">

                            <span class="material-symbols-outlined">shopping_cart</span>

                            </div>

                            <div>

                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Compra de pacote — 10 créditos</h5>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">15 Jan, 14:32 • Cartão de crédito</p>

                            </div>

                        </div>

                        <div class="text-right">

                            <span class="text-[16px] leading-[24px] font-bold text-[#16A34A]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">+ 10</span>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 30</p>

                        </div>

                        </div>

  

                        <!-- Transaction Item: System Bonus -->

                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer opacity-80 shadow-sm">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-lg bg-black/10 flex items-center justify-center text-black">

                            <span class="material-symbols-outlined">redeem</span>

                            </div>

                            <div>

                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Bônus de Indicação</h5>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">15 Jan, 11:00 • Programa Skilla+</p>

                            </div>

                        </div>

                        <div class="text-right">

                            <span class="text-[16px] leading-[24px] font-bold text-[#16A34A]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">+ 2</span>

                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 20</p>

                        </div>

                        </div>

                    </div>

                    </div>

                </section>

  

                <!-- Bottom Illustration / CTA -->

                <section class="mt-12 py-10 text-center border-t border-black/10">

                    <p class="text-[16px] leading-[24px] text-gray-600 mb-6" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">

                    Precisa de mais visibilidade? Use seus créditos para destacar seu perfil.

                    </p>

                </section>

  

                </div>

            </main>

            </div>

        `;
```