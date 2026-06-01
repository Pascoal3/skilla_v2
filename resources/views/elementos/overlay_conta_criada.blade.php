<!-- Overlay de Sucesso (Conta Criada) -->
<div id="success-overlay-container" class="fixed inset-0 z-[200] hidden bg-white min-h-screen flex flex-col">

    <!-- Main Success Content -->
    <main class="flex-grow flex items-center justify-center px-container-padding py-section-gap">
        <div class="max-w-4xl w-full text-center flex flex-col items-center">
            <!-- Success Illustration -->
            <div class="relative mb-12">
                <div class="absolute inset-0 bg-primary-fixed opacity-10 blur-3xl rounded-full"></div>
                <div class="relative w-48 h-64 bg-surface-container-low border border-outline-variant rounded-lg flex flex-col items-center justify-center p-8 neon-glow">
                    <div class="w-24 h-24 rounded-full bg-surface-container-high flex items-center justify-center mb-6 overflow-hidden border-2 border-primary-fixed">
                        <span class="material-symbols-outlined text-primary-fixed" style="font-size: 64px; font-variation-settings: 'FILL' 1, 'wght' 300, 'GRAD' 0, 'opsz' 48;">person</span>
                    </div>
                    <div class="w-16 h-2 bg-primary-fixed rounded-full mb-3 opacity-80"></div>
                    <div class="w-24 h-2 bg-outline-variant rounded-full opacity-40"></div>
                    <div class="absolute -bottom-4 -right-4 bg-primary-fixed text-on-primary-fixed w-12 h-12 rounded-full flex items-center justify-center shadow-lg border-4 border-background">
                        <span class="material-symbols-outlined font-bold" style="font-variation-settings: 'wght' 700;">check</span>
                    </div>
                </div>
            </div>

            <h1 class="font-h1 text-h1 text-primary-fixed mb-6 max-w-3xl leading-tight">
                Parabéns, sua conta foi criada com sucesso!
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl mx-auto">
                Sua jornada profissional em Angola começa agora. Vamos começar a encontrar os melhores talentos e oportunidades para o seu projeto.
            </p>
        </div>
    </main>

    <!-- Decorative Elements -->
    <div class="fixed top-1/4 -left-12 w-24 h-[1px] bg-primary-fixed opacity-20 rotate-45 pointer-events-none"></div>
    <div class="fixed bottom-1/4 -right-12 w-48 h-[1px] bg-primary-fixed opacity-10 -rotate-12 pointer-events-none"></div>
</div>