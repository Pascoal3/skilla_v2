<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script>
        window.FontAwesomeConfig = {
          autoReplaceSvg: 'nest'
        };
      </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skilla - Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        #div_footer {
            font-family: 'Inter', sans-serif;
            background-color: #EDE8DC;
        }
        .topo-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='1000' height='1000' viewBox='0 0 1000 1000' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(255,255,255,0.06)' stroke-width='1.5'%3E%3Cpath d='M0 200 C 150 150 350 250 500 200 S 850 150 1000 200'/%3E%3Cpath d='M0 400 C 200 350 400 450 600 400 S 800 350 1000 400'/%3E%3Cpath d='M0 600 C 100 580 300 650 500 600 S 900 550 1000 600'/%3E%3Cpath d='M0 800 C 250 750 450 850 750 800 S 1000 750 1000 800'/%3E%3Cpath d='M200 0 C 150 150 250 350 200 500 S 150 850 200 1000'/%3E%3Cpath d='M400 0 C 350 200 450 400 400 600 S 350 800 400 1000'/%3E%3Cpath d='M600 0 C 580 100 650 300 600 500 S 550 900 600 1000'/%3E%3C/g%3E%3C/svg%3E");
            background-size: cover;
        }
        .skilla-logo {
            font-weight: 900;
            font-style: italic;
            letter-spacing: -0.05em;
        }
    </style>
</head>
<div id="div_footer" class="antialiased">


    <!-- Footer Card -->
    <footer class="px-4 md:px-24 pb-12">
        <div class="max-w-7xl mx-auto bg-[#12200F] rounded-[20px] relative topo-pattern pt-16 px-12 pb-8 overflow-visible">
            
            <!-- Logo Badge -->
            <div class="absolute -top-[40px] left-1/2 -translate-x-1/2 w-[80px] h-[80px] bg-[#D4F03D] rounded-full flex items-center justify-center border-[6px] border-[#EDE8DC] z-10 shadow-lg">
                <span class="text-[36px] font-black text-black"><img src="/img/logo_skilla7-removebg-preview.png" alt=""></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
                
                <!-- Col 1: Contato -->
                <div class="md:col-span-2 flex flex-col">
                    <h4 class="text-white font-semibold text-[13px] mb-4">Contato</h4>
                    <p class="text-gray-400 text-[13px] mb-2">Rua das Flores, 123 – São Paulo, SP</p>
                    <a href="mailto:suporte@skilla.com" class="text-[#D4F03D] text-[13px] underline decoration-[#D4F03D]/50 mb-4">suporte@skilla.com</a>
                    
                    <div class="inline-flex items-center space-x-2 border border-white/20 rounded-full px-3 py-1.5 w-fit mt-3 mb-6 bg-white/5">
                        <span class="text-white text-[11px] font-bold">4.9</span>
                        <span class="text-[#D4F03D] text-[10px]">★</span>
                        <span class="text-white text-[11px]">Trustpilot</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <div class="bg-white/10 px-2 py-1 rounded-md text-white/50 text-[10px] flex items-center">
                            <i class="fa-brands fa-cc-visa mr-1"></i> VISA
                        </div>
                        <div class="bg-white/10 px-2 py-1 rounded-md text-white/50 text-[10px] flex items-center">
                            <i class="fa-brands fa-cc-mastercard mr-1"></i> MC
                        </div>
                        <div class="bg-white/10 px-2 py-1 rounded-md text-white/50 text-[10px] flex items-center">
                            <i class="fa-brands fa-cc-paypal mr-1"></i> PayPal
                        </div>
                    </div>
                </div>

                <!-- Col 2: Social -->
                <div class="md:col-span-2 flex flex-col">
                    <h4 class="text-white font-semibold text-[13px] mb-4">Social</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 text-[13px] hover:text-white flex items-center">Linkedin <span class="ml-1 text-[10px]">↗</span></a></li>
                        <li><a href="#" class="text-gray-300 text-[13px] hover:text-white flex items-center">Instagram <span class="ml-1 text-[10px]">↗</span></a></li>
                        <li><a href="#" class="text-gray-300 text-[13px] hover:text-white flex items-center">Facebook <span class="ml-1 text-[10px]">↗</span></a></li>
                        <li><a href="#" class="text-gray-300 text-[13px] hover:text-white flex items-center">Twitter <span class="ml-1 text-[10px]">↗</span></a></li>
                        <li><a href="#" class="text-gray-300 text-[13px] hover:text-white flex items-center">YouTube <span class="ml-1 text-[10px]">↗</span></a></li>
                    </ul>
                </div>

                <!-- Col 3: Branding -->
                <div class="md:col-span-4 flex flex-col items-center md:items-start text-center md:text-left">
                    <span class="text-[#D4F03D] text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Branding</span>
                    <h3 class="text-white text-[72px] skilla-logo leading-none mb-2">Skilla</h3>
                    <p class="text-gray-400 italic text-[13px] mb-6">Onde o talento encontra a oportunidade.</p>
                    
                    <div class="flex flex-row space-x-3 w-full max-w-sm">
                        <button class="bg-[#D4F03D] text-black font-bold py-3 px-6 rounded-full text-[13px] hover:opacity-90 transition-all flex-1 flex items-center justify-center">
                            Começar grátis <span class="ml-2">→</span>
                        </button>
                        <button class="border border-white text-white font-semibold py-3 px-6 rounded-full text-[13px] hover:bg-white hover:text-black transition-all flex-1 flex items-center justify-center">
                            Publicar projeto +
                        </button>
                    </div>
                </div>

                <!-- Col 4: Links -->
                <div class="md:col-span-4 flex flex-col">
                    <h4 class="text-white font-semibold text-[13px] mb-4">Links</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Sobre a Skilla</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Carreiras</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Imprensa</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Blog</a></li>
                        </ul>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Ajuda</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Central de Suporte</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Comunidade</a></li>
                            <li><a href="#" class="text-gray-300 text-[13px] hover:text-white">Segurança</a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-gray-500 text-xs mb-4 md:mb-0">©2025 Skilla. Todos os direitos reservados.</p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-500 text-xs hover:text-white transition-colors">Termos de Uso</a>
                    <span class="text-white/10">|</span>
                    <a href="#" class="text-gray-500 text-xs hover:text-white transition-colors">Política de Privacidade</a>
                </div>
            </div>

        </div>
    </footer>

</div>
</html>