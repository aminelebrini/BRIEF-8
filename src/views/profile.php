<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    
    if(!isset($_SESSION['user']))
    {
        header("Location: /home");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Mon Profil — MyLibrary</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .profile-card { background: linear-gradient(145deg, #141618, #1c1f22); }
    </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen flex flex-col">

    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span></h1>

            <?php if(isset($_SESSION['user'])): ?>
                <nav class="hidden md:flex gap-6 text-xs font-bold uppercase tracking-widest text-gray-400">
                    <a href="/home" class="hover:text-white transition">Accueil</a>
                    <a href="/service" class="hover:text-white transition">Services</a>
                    <a href="/profile" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Profile</a>
                    
                    <?php if($_SESSION['user']['role'] === 'reader'): ?>
                        <a href="/books" class="hover:text-white transition">BOOKS</a>
                        <a href="/reserved" class="hover:text-white transition">RESERVATIONS</a>
                    <?php elseif($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/dashboard" class="hover:text-white transition">Dashboard</a>
                        <a href="/reserveadmin" class="hover:text-white transition">RESERVATIONS</a>
                        <a href="/allusers" class="hover:text-white transition">Gestion Users</a>
                    <?php endif; ?>
                </nav>

                <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs text-gray-400">Bienvenue,</p>
                        <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                    </div>
                    <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="user">
                    <form method="POST">
                        <button type="submit" name="logout" class="text-gray-400 hover:text-red-500 transition">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <nav class="flex gap-4 text-sm font-medium">
                    <a href="/formulaire" class="px-5 py-2 rounded-full bg-white text-black hover:bg-gray-200 transition">Connexion</a>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-20 flex-grow">
        <div class="profile-card border border-white/5 rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#6139B4]/10 blur-[80px] rounded-full"></div>
            
            <div class="relative flex flex-col md:flex-row items-center gap-10">
                <div class="relative">
                    <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-32 h-32 rounded-full object-cover border-4 border-[#1c1f22] shadow-[0_0_20px_rgba(97,57,180,0.3)]" alt="avatar">
                    <div class="absolute bottom-2 -right-3 bg-[#6139B4] w-8 h-8 rounded-full flex items-center justify-center border-4 border-[#141618]">
                        <i class="fa-solid fa-check text-[10px] text-white"></i>
                    </div>
                </div>

                <div class="text-center md:text-left flex-1">
                    <div class="inline-block px-3 py-1 rounded-full bg-[#6139B4]/10 border border-[#6139B4]/20 text-[#a78bfa] text-[10px] font-bold uppercase tracking-[0.2em] mb-4">
                        Status : <?= htmlspecialchars($_SESSION['user']['role']) ?>
                    </div>
                    <h2 class="text-4xl font-extrabold text-white mb-2 tracking-tight">
                        <?= htmlspecialchars($_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']) ?>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-12">
                
                <div class="bg-white/5 border border-white/5 rounded-2xl p-6 hover:bg-white/10 transition group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#6139B4]/20 flex items-center justify-center text-[#a78bfa] group-hover:scale-110 transition">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] text-gray-500 font-bold uppercase tracking-wider">Adresse Email</span>
                            <span class="text-gray-200 font-medium"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/5 rounded-2xl p-6 hover:bg-white/10 transition group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#6139B4]/20 flex items-center justify-center text-[#a78bfa] group-hover:scale-110 transition">
                            <i class="fa-solid fa-id-badge"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] text-gray-500 font-bold uppercase tracking-wider">Niveau d'Accès</span>
                            <span class="text-gray-200 font-medium"><?= ucfirst(htmlspecialchars($_SESSION['user']['role'])) ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="border-t border-white/5 bg-[#0f1113] py-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center gap-4">
            <p class="text-gray-500 text-sm italic text-center">
                © 2025 <span class="text-white font-semibold">MyLibrary</span> — Le futur de la lecture commence ici.
            </p>
        </div>
    </footer>
</body>
</html>