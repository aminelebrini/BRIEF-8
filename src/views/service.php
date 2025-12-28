<?php
    include __DIR__ . "/../controllers/Auth.php";
    $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyLibrary — Services</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
    .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3]">

<?php if(isset($_SESSION['user'])): ?>
    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold tracking-tight">My<span class="gradient-text">Library</span></h1>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-sm uppercase font-bold text-gray-400">
                <a href="/home" class="hover:text-white transition-colors">Accueil</a>
                <a href="/service" class="text-[#a78bfa] font-bold uppercase border-b-2 border-[#6139B4] pb-1">Services</a>
                <a href="/profile" class="hover:text-white font-bold uppercase transition-colors">Profil</a>
                
                <?php if($_SESSION['user']['role'] === 'reader'): ?>
                    <a href="/book" class="hover:text-white transition-colors font-bold uppercase tracking-wider text-xs">LIVRES</a>
                    <a href="/reserved" class="hover:text-white transition-colors font-bold uppercase tracking-wider text-xs">Réservations</a>
                <?php else: ?>
                    <a href="/dashboard" class="hover:text-white font-bold transition-colors">Dashboard</a>
                    <a href="/reserveadmin" class="hover:text-white font-bold transition-colors uppercase tracking-wider text-xs">Réservations</a>
                    <a href="/allusers" class="hover:text-white font-bold transition-colors">Users</a>
                <?php endif; ?>
            </nav>

            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-gray-400">Bienvenue,</p>
                    <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                </div>
                <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="avatar">
                
                <form method="POST">
                    <button type="submit" name="logout" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-right-from-bracket text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

<?php else: ?>
    <header class="glass sticky top-0 z-50 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight">📚 My<span class="gradient-text">Library</span></h1>
            <nav class="flex gap-8 text-sm font-medium">
                <a href="/home" class="text-gray-400 hover:text-white">Accueil</a>
                <a href="/service" class="text-white">Services</a>
            </nav>
            <a href="/formulaire" class="px-5 py-2 rounded-full bg-white text-black font-semibold text-sm hover:bg-gray-200">
                Connexion
            </a>
        </div>
    </header>
<?php endif; ?>

<main class="max-w-7xl mx-auto px-6 py-16">
    <section class="grid lg:grid-cols-2 gap-16 items-center mb-24">
        <div class="space-y-8 text-center lg:text-left">
            <h2 class="text-5xl font-bold leading-tight">
                Gérez vos lectures <br/>
                <span class="gradient-text">en toute simplicité</span>
            </h2>
            <p class="text-gray-400 text-lg max-w-lg mx-auto lg:mx-0">
                MyLibrary est votre compagnon numérique pour explorer, réserver et gérer vos ouvrages préférés sans effort.
            </p>
            <div class="flex gap-4 justify-center lg:justify-start">
                <a href="/book" class="px-8 py-4 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] font-bold transition shadow-lg shadow-[#6139B4]/20">
                    Explorer le catalogue
                </a>
            </div>
        </div>

        <div class="bg-[#141618] border border-white/5 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#6139B4]/10 blur-3xl"></div>
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <i class="fa-solid fa-star text-yellow-500"></i> Vos Avantages
            </h3>
            <ul class="space-y-4">
                <li class="flex items-center gap-4 p-3 bg-white/5 rounded-xl border border-white/5">
                    <i class="fa-solid fa-bolt text-[#a78bfa]"></i> 
                    <span>Réservation en 1 clic</span>
                </li>
                <li class="flex items-center gap-4 p-3 bg-white/5 rounded-xl border border-white/5">
                    <i class="fa-solid fa-clock text-[#a78bfa]"></i> 
                    <span>Historique de lecture disponible</span>
                </li>
                <li class="flex items-center gap-4 p-3 bg-white/5 rounded-xl border border-white/5">
                    <i class="fa-solid fa-shield-halved text-[#a78bfa]"></i> 
                    <span>Données personnelles sécurisées</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="mb-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4 italic">Comment ça marche ?</h2>
            <div class="w-20 h-1 bg-[#6139B4] mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-8 bg-[#141618] border border-white/5 rounded-2xl hover:border-[#6139B4]/50 transition">
                <div class="w-12 h-12 bg-[#6139B4]/20 rounded-lg flex items-center justify-center mb-6 text-[#a78bfa] text-xl font-bold">1</div>
                <h4 class="text-xl font-bold mb-3">Recherchez</h4>
                <p class="text-gray-400 text-sm">Parcourez notre catalogue riche de milliers de références par auteur, titre ou année.</p>
            </div>

            <div class="p-8 bg-[#141618] border border-white/5 rounded-2xl hover:border-[#6139B4]/50 transition">
                <div class="w-12 h-12 bg-[#6139B4]/20 rounded-lg flex items-center justify-center mb-6 text-[#a78bfa] text-xl font-bold">2</div>
                <h4 class="text-xl font-bold mb-3">Réservez</h4>
                <p class="text-gray-400 text-sm">Cliquez sur le bouton réserver pour bloquer votre livre instantanément dans votre panier.</p>
            </div>

            <div class="p-8 bg-[#141618] border border-white/5 rounded-2xl hover:border-[#6139B4]/50 transition">
                <div class="w-12 h-12 bg-[#6139B4]/20 rounded-lg flex items-center justify-center mb-6 text-[#a78bfa] text-xl font-bold">3</div>
                <h4 class="text-xl font-bold mb-3">Gérez</h4>
                <p class="text-gray-400 text-sm">Consultez votre espace "Réservations" pour suivre vos emprunts et annuler si nécessaire.</p>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-[#6139B4]/20 to-transparent p-12 rounded-3xl border border-white/5 text-center">
        <div class="grid sm:grid-cols-3 gap-8">
            <div>
                <p class="text-4xl font-bold text-white mb-2">5000+</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest font-bold">Livres</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-white mb-2">1200+</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest font-bold">Lecteurs</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-white mb-2">24h/24</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest font-bold">Disponibilité</p>
            </div>
        </div>
    </section>
</main>

<footer class="border-t border-white/5 bg-[#0f1113] py-12 text-center text-gray-500 text-sm">
    <div class="mb-6">
        <h2 class="text-white font-bold text-lg mb-2">MyLibrary</h2>
        <p class="max-w-xs mx-auto text-xs">La meilleure plateforme pour les amoureux des livres et les bibliothécaires modernes.</p>
    </div>
    <p>© 2025 MyLibrary — Tous droits réservés</p>
</footer>

</body>
</html>