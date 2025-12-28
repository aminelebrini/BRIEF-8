<?php
  include_once __DIR__ . "/../controllers/Auth.php";
  include_once __DIR__ . "/../controllers/AdminMeth.php";

$_SESSION['user'] ?? null;
$Readers = $adminbook->allusers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestion Utilisateurs — MyLibrary</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
    .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .user-card { background: #141618; border: 1px solid rgba(255,255,255,0.05); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .user-card:hover { border-color: #6139B4; transform: translateY(-8px); shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
  </style>
</head>

<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen flex flex-col">
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span> Admin</h1>

            <nav class="hidden md:flex gap-6 text-xs font-bold uppercase tracking-widest text-gray-400">
                <a href="/home" class="hover:text-white transition">Accueil</a>
                <a href="/service" class="hover:text-white transition">Services</a>
                <a href="/profile" class="hover:text-white transition">Profile</a>
                <a href="/dashboard" class="hover:text-white transition">Dashboard</a>
                <a href="/reserveadmin" class="hover:text-white transition">RESERVATIONS</a>
                <a href="/allusers" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Gestion Users</a>
            </nav>

            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                    <p class="text-[9px] text-[#a78bfa] font-bold uppercase tracking-tighter">Admin</p>
                </div>
                <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="admin">
                <form method="POST">
                    <button type="submit" name="logout" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>        
<?php endif; ?>

<main class="max-w-7xl mx-auto px-6 py-12 flex-grow">
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-4xl font-extrabold tracking-tight italic">Nos <span class="gradient-text">Membres</span></h2>
        </div>
        <div class="bg-white/5 px-4 py-2 rounded-xl border border-white/10 text-xs font-mono">
            Total : <span class="text-[#a78bfa] font-bold"><?= count($Readers); ?></span> utilisateurs
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <?php foreach($Readers as $reader): ?>
            <div class="user-card rounded-[2rem] overflow-hidden flex flex-col group relative">
                
                <div class="absolute top-4 right-4 z-10">
                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest <?= $reader['role'] === 'admin' ? 'bg-[#6139B4] text-white' : 'bg-white/10 text-gray-300' ?> border border-white/10 backdrop-blur-md">
                        <?= htmlspecialchars($reader['role']) ?>
                    </span>
                </div>

                <div class="relative w-full h-56 overflow-hidden">
                    <img src="<?= htmlspecialchars($reader['avatar_url']) ?>" 
                         alt="Avatar"
                         class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#141618] via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="p-6 flex flex-col gap-4 relative">
                    <div>
                        <h2 class="text-xl font-bold text-white group-hover:text-[#a78bfa] transition-colors">
                            <?= htmlspecialchars($reader['firstname'] . ' ' . $reader['lastname']) ?>
                        </h2>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-xs text-gray-400">
                            <i class="fa-solid fa-envelope w-4 text-[#6139B4]"></i>
                            <span class="truncate italic"><?= htmlspecialchars($reader['email']) ?></span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-400">
                            <i class="fa-solid fa-shield-halved w-4 text-[#6139B4]"></i>
                            <span class="font-medium">Status : 
                                <span class="text-white italic"><?= ucfirst(htmlspecialchars($reader['role'])) ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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