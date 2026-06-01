<!DOCTYPE html>
<html class="dark" lang="pt-AO">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | SKILLA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#caf216",
                        "background": "#f8fafc",
                        "surface": "#ffffff",
                        "brand-purple": "#8B5CF6",
                        "brand-blue": "#3B82F6",
                        "error": "#ff4ab",
                        "error-container": "#93000a",
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "label-caps": ["Space Grotesk"],
                        "h1": ["Space Grotesk"],
                        "h2": ["Space Grotesk"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {"lineHeight": "1.0", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "h1": ["72px", {"lineHeight": "1.0", "letterSpacing": "-0.04em", "fontWeight": "700"}],
                        "h2": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.03em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "letterSpacing": "0em", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "letterSpacing": "0em", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #F1F5F9;
            color: #0F172A;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        #logo_plataforma {
            width: 80px;
            height: 80px;
        }
        .login-card {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        }
        .input-shadow {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        }
        .gradient-button {
            background-color: #00008B;
            color: white;
        }
        .gradient-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .border-error {
            border-color: #ff4ab !important;
        }
        .text-error {
            color: #ff4ab;
        }
        
        /* Loading Overlay */
        @keyframes custom-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-custom-spin {
            animation: custom-spin 1.2s linear infinite;
        }
        @keyframes loading-bar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(300%); }
        }
        .animate-loading-bar {
            animation: loading-bar 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-body-md antialiased">

<main class="min-h-screen pt-32 pb-20 flex items-center justify-center px-4">
    
    <!-- Login Card -->
    <div class="w-full max-w-md bg-white rounded-[3rem] p-8 md:p-12 login-card relative overflow-hidden">
        
        <!-- Header do Card -->
        <div class="flex flex-col items-center mb-10">
            <img id="logo_plataforma" src="{{ asset('img/logo_skilla8_invertido-removebg-preview.png') }}" alt="SKILLA">
            <div style="background-color: #00008B" class="w-24 h-24 rounded-full flex items-center justify-center text-white mb-4 shadow-lg">
                <span class="material-symbols-outlined text-5xl">person</span>
            </div>
            <h1 class="font-h1 text-4xl text-slate-800 font-bold">Login</h1>
        </div>

        <!-- Mensagem de Erro Global (se houver) -->
        <div id="global-error" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-error">error</span>
                <p class="text-error text-sm font-medium" id="global-error-message"></p>
            </div>
        </div>

        <form id="login-form" class="space-y-6" novalidate>
            <!-- Email Field -->
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center px-1">
                    <label class="font-body-md font-semibold text-slate-600">Email</label>
                    <a href="#" class="text-xs text-blue-500 hover:underline font-medium">Esqueceu a senha?</a>
                </div>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                    <input id="email-input" 
                           class="w-full bg-slate-50 border border-slate-100 input-shadow rounded-full py-4 pl-12 pr-4 focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition-all font-body-md text-slate-700" 
                           placeholder="Digite seu e-mail" 
                           type="email"
                           autocomplete="email"/>
                </div>
                <span id="email-error" class="text-error text-sm font-medium mt-1 flex items-center gap-1 hidden px-1">
                    <span class="material-symbols-outlined text-[16px]">error</span>
                    <span>Por favor, insira um endereço de e-mail válido</span>
                </span>
            </div>

            <!-- Password Field -->
            <div class="flex flex-col gap-2">
                <label class="font-body-md font-semibold text-slate-600 px-1">Senha</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                    <input id="password-input" 
                           class="w-full bg-slate-50 border border-slate-100 input-shadow rounded-full py-4 pl-12 pr-12 focus:ring-2 focus:ring-blue-400 focus:border-transparent outline-none transition-all font-body-md text-slate-700" 
                           placeholder="Digite sua senha" 
                           type="password"
                           autocomplete="current-password"/>
                    <button type="button" id="toggle-password" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                </div>
                <span id="password-error" class="text-error text-sm font-medium mt-1 flex items-center gap-1 hidden px-1">
                    <span class="material-symbols-outlined text-[16px]">error</span>
                    <span>Por favor, insira sua senha</span>
                </span>
            </div>

            <!-- Login Button -->
            <button id="submit-button" type="submit" class="w-full gradient-button text-white font-bold py-4 rounded-full text-lg shadow-lg hover:opacity-90 transition-all active:scale-[0.98] mt-4 disabled:opacity-50 disabled:cursor-not-allowed">
                Entrar
            </button>

            <!-- Sign Up Link -->
            <div class="text-center pt-6">
                <p class="text-body-md text-slate-500">
                    Ainda não registrado? <a href="{{ route('pagina_escolher_funcao') }}" class="text-blue-600 font-bold hover:underline ml-1">Cadastrar-se &rsaquo;</a>
                </p>
            </div>
        </form>
    </div>
</main>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-white/80 backdrop-blur-xl hidden">
    <div class="relative w-full max-w-md mx-4 p-12 bg-white rounded-xl border border-white/5 shadow-2xl overflow-hidden">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-[#D6FF2A]/5 rounded-full blur-[64px]"></div>
        
        <div class="relative flex flex-col items-center text-center space-y-8">
            <div class="font-['Space_Grotesk'] text-xs font-black tracking-[0.4em] text-slate-400 uppercase">
                SKILLA
            </div>
            
            <div class="relative flex items-center justify-center">
                <div class="w-20 h-20 rounded-full border-t-2 border-r-2 border-transparent border-t-[#D6FF2A] border-r-[#D6FF2A]/30 animate-custom-spin"></div>
                <div class="absolute inset-0 m-auto w-12 h-12 rounded-full border border-[#D6FF2A]/10 animate-pulse"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#D6FF2A]/40 text-xl" data-icon="bolt">bolt</span>
                </div>
            </div>
            
            <div class="space-y-3">
                <h2 class="font-h2 text-h2 text-[#D6FF2A] leading-none">Quase lá</h2>
                <p class="font-body-md text-slate-500 max-w-[240px] mx-auto">
                    Aguarde enquanto verificamos suas credenciais
                </p>
            </div>
            
            <div class="w-full max-w-[160px] h-[2px] bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-[#D6FF2A] w-1/3 animate-loading-bar"></div>
            </div>
            
            <div class="mt-12 flex justify-center">
                <span class="text-[10px] uppercase tracking-widest text-slate-600 font-bold">Processamento Seguro</span>
            </div>
        </div>
    </div>
</div>

<!-- Success Overlay -->
<div id="success-overlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-white/90 backdrop-blur-xl hidden">
    <div class="relative w-full max-w-md mx-4 p-12 bg-white rounded-xl border border-white/5 shadow-2xl overflow-hidden">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-[#D6FF2A]/5 rounded-full blur-[64px]"></div>
        
        <div class="relative flex flex-col items-center text-center space-y-8">
            <div class="w-24 h-24 rounded-full bg-[#D6FF2A]/10 flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-[#D6FF2A] text-5xl" data-icon="check">check</span>
            </div>
            
            <div class="space-y-3">
                <h2 class="font-h2 text-h2 text-[#D6FF2A] leading-none">Bem-vindo de volta!</h2>
                <p class="font-body-md text-slate-500 max-w-[240px] mx-auto">
                    Login realizado com sucesso. Redirecionando...
                </p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>