<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 - Page Introuvable | MyLibrary</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { 
        font-family: 'Inter', sans-serif; 
    }
    .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
    .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }
  </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen flex flex-col">

    <main class="flex-grow flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#6139B4]/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-[#a78bfa]/10 blur-[100px] rounded-full animate-pulse"></div>

        <div class="relative z-10 text-center space-y-8">
            <div class="relative inline-block animate-float">
                <span class="text-[10rem] md:text-[15rem] font-black opacity-10 leading-none select-none">404</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fa-solid fa-book-open-reader text-7xl text-[#6139B4] drop-shadow-[0_0_15px_rgba(97,57,180,0.5)]"></i>
                </div>
            </div>

            <div class="space-y-4 max-w-md mx-auto">
                <h1 class="text-4xl font-bold italic">Page <span class="gradient-text">égarée</span>...</h1>
                <p class="text-gray-400 text-lg italic leading-relaxed">
                    Il semble que ce chapitre n'existe pas encore ou qu'il ait été retiré des rayons.
                </p>
            </div>

            <div class="pt-6">
                <a href="/home" class="group relative inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-[#6139B4] hover:bg-[#4f2d91] text-white font-bold transition-all shadow-lg shadow-[#6139B4]/20 hover:shadow-[#6139B4]/40 active:scale-95">
                    <i class="fa-solid fa-house transition-transform group-hover:-translate-x-1"></i>
                    Retourner à l'accueil
                </a>
            </div>

            <div class="flex items-center justify-center gap-8 pt-12 border-t border-white/5">
                <a href="/books" class="text-xs uppercase tracking-[0.3em] text-gray-500 hover:text-white transition">Livres</a>
                <a href="/service" class="text-xs uppercase tracking-[0.3em] text-gray-500 hover:text-white transition">Services</a>
                <a href="/profile" class="text-xs uppercase tracking-[0.3em] text-gray-500 hover:text-white transition">Mon profil</a>
            </div>
        </div>
    </main>

    <footer class="border-t border-white/5 bg-[#0f1113] py-10 w-full">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center gap-4">
            <p class="text-gray-500 text-sm italic text-center">
                © 2025 <span class="text-white font-semibold">MyLibrary</span> — Le futur de la lecture commence ici.
            </p>
            <div class="flex gap-6 text-[10px] uppercase tracking-[0.3em] text-gray-600">
                <a href="#" class="hover:text-white transition">Confidentialité</a>
                <a href="#" class="hover:text-white transition">Support</a>
            </div>
        </div>
    </footer>

</body>
</html>