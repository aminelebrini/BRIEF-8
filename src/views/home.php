<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil — MyLibrary</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
    .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] selection:bg-[#6139B4]">

<header class="sticky top-0 z-50 glass border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span></h1>

        <?php if(isset($_SESSION['user'])): ?>
            <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-gray-400">
                <a href="/home" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Accueil</a>
                <a href="/service" class="hover:text-white transition">Services</a>
                <a href="/profile" class="hover:text-white transition">Profil</a>
                
                <?php if($_SESSION['user']['role'] === 'reader'): ?>
                    <a href="/books" class="hover:text-white transition">Books</a>
                    <a href="/reserved" class="hover:text-white transition">Réservations</a>
                <?php elseif($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/dashboard" class="hover:text-white transition">Dashboard</a>
                    <a href="/reserveadmin" class="hover:text-white transition">Réservations</a>
                    <a href="/allusers" class="hover:text-white transition">Users</a>
                <?php endif; ?>
            </nav>

            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-gray-400">Bienvenue,</p>
                    <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                </div>
                <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="avatar">
                <form method="POST">
                    <button type="submit" name="logout" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-power-off text-lg"></i>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <nav class="flex gap-8 text-sm font-medium">
                <a href="/home" class="text-white">Accueil</a>
                <a href="/service" class="text-gray-400 hover:text-white">Services</a>
                <a href="/formulaire" class="px-5 py-2 rounded-full bg-white text-black font-semibold hover:bg-gray-200 transition">Connexion</a>
            </nav>
        <?php endif; ?>
    </div>
</header>

<main class="relative overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#6139B4]/10 blur-[120px] rounded-full"></div>

    <section class="relative max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#6139B4]/10 border border-[#6139B4]/20 text-[#a78bfa] text-[10px] font-bold uppercase tracking-widest">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#a78bfa] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#a78bfa]"></span>
                </span>
                Disponible maintenant
            </div>

            <h2 class="text-5xl md:text-6xl font-extrabold leading-tight">
                Votre <span class="gradient-text">Bibliothèque</span> <br/>
                Réinventée.
            </h2>
            
            <p class="text-gray-400 text-lg leading-relaxed max-w-lg italic">
                Découvrez, empruntez et gérez vos ouvrages avec une fluidité numérique totale. Une plateforme pensée pour les passionnés de lecture.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="/books" class="px-8 py-4 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] font-bold shadow-lg shadow-[#6139B4]/20 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-book-open"></i> Commencer
                </a>
                <a href="#features" class="px-8 py-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 font-bold transition-all">
                    En savoir plus
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-[#6139B4]/20 to-transparent blur-3xl rounded-full"></div>
            <div class="relative bg-[#141618] border border-white/5 rounded-3xl p-8 shadow-2xl">
                <p class="text-[#a78bfa] text-xs font-bold uppercase tracking-widest mb-6">Pourquoi choisir MyLibrary ?</p>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-lg bg-[#6139B4]/20 flex items-center justify-center text-[#a78bfa] group-hover:scale-110 transition">
                            <i class="fa-solid fa-feather"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Gestion Intuitive</h4>
                            <p class="text-xs text-gray-500 italic">Interface simplifiée pour vos réservations quotidiennes.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-lg bg-[#6139B4]/20 flex items-center justify-center text-[#a78bfa] group-hover:scale-110 transition">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Accès Instantané</h4>
                            <p class="text-xs text-gray-500 italic">Consultez les stocks de livres en temps réel.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-lg bg-[#6139B4]/20 flex items-center justify-center text-[#a78bfa] group-hover:scale-110 transition">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">Espaces Dédiés</h4>
                            <p class="text-xs text-gray-500 italic">Outils spécifiques pour lecteurs et administrateurs.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<footer class="border-t border-white/5 bg-[#0f1113] py-10 mt-12">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <p class="text-gray-500 text-sm italic">
            © 2025 <span class="text-white font-semibold">MyLibrary</span> — Le futur de la lecture commence ici.
        </p>
        <div class="flex gap-6 text-xs font-bold uppercase tracking-widest text-gray-500">
            <a href="#" class="hover:text-white">Confidentialité</a>
            <a href="#" class="hover:text-white">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>