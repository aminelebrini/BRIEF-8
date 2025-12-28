<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";

    $AllRese = $adminbook->display_all_reservation();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Gestion Réservations — MyLibrary</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen">

<?php if($_SESSION['user']['role'] === 'admin'): ?>
    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span> Admin</h1>
            
            <nav class="hidden md:flex gap-6 text-xs font-bold uppercase tracking-widest text-gray-400">
                <a href="/home" class="hover:text-white transition">Accueil</a>
                <a href="/service" class="hover:text-white transition">Services</a>
                <a href="/dashboard" class="hover:text-white transition">Dashboard</a>
                <a href="/reserveadmin" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Réservations</a>
                <a href="/allusers" class="hover:text-white transition">Users</a>
            </nav>

            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] text-gray-500 font-bold uppercase">Administrateur</p>
                    <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                </div>
                <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="admin">
                <form method="POST">
                    <button type="submit" name="logout" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-power-off text-lg"></i>
                    </button>
                 </form>
            </div>
        </div>
    </header> 
<?php endif; ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10">
            <h2 class="text-3xl font-bold italic"><i class="fa-solid fa-list-check text-[#6139B4] mr-3"></i>Liste des <span class="gradient-text">Réservations Globales</span></h2>
            <p class="text-gray-400 mt-2 italic text-sm underline decoration-[#6139B4]">Vue d'ensemble de tous les emprunts en cours dans la bibliothèque.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($AllRese as $res): ?>
                <div class="bg-[#141618] border border-white/5 rounded-2xl shadow-lg p-6 flex flex-col gap-4 transition hover:border-[#6139B4]/40 hover:-translate-y-1 relative overflow-hidden group">
                    
                    <div class="border-b border-white/5 pb-3">
                        <h2 class="text-xl font-bold text-white group-hover:text-[#a78bfa] transition"><?= htmlspecialchars($res['title']) ?></h2>
                        <p class="text-xs text-[#a78bfa] font-mono mt-1 italic">Par <?= htmlspecialchars($res['author']) ?></p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm">
                            <i class="fa-solid fa-user text-gray-500 w-4 text-center text-xs"></i>
                            <span class="text-gray-400 italic">Lecteur :</span>
                            <span class="text-white font-medium"><?= htmlspecialchars($res['firstname'] . ' ' . $res['lastname']) ?></span>
                        </div>

                        <div class="flex items-center gap-3 text-sm">
                            <i class="fa-solid fa-calendar-plus text-gray-500 w-4 text-center text-xs"></i>
                            <span class="text-gray-400 italic">Sortie :</span>
                            <span class="text-white font-medium"><?= htmlspecialchars($res['borrow_date']) ?></span>
                        </div>

                        <div class="flex items-center gap-3 text-sm">
                            <i class="fa-solid fa-calendar-check text-gray-500 w-4 text-center text-xs"></i>
                            <span class="text-gray-400 italic">Retour :</span>
                            <span class="text-white font-medium"><?= htmlspecialchars($res['return_date']) ?></span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-white/5">
                        <?php 
                            $today = new DateTime();
                            $returnedDate = new DateTime($res['return_date']);

                            if ($today > $returnedDate): ?>
                                <div class="flex items-center gap-2 text-red-400 bg-red-400/10 p-2 rounded-lg border border-red-400/20">
                                    <i class="fa-solid fa-triangle-exclamation animate-pulse"></i>
                                    <span class="text-xs font-bold uppercase tracking-tighter">À retourner immédiatement !</span>
                                </div>
                            <?php else: ?>
                                <div class="flex items-center gap-2 text-emerald-400 bg-emerald-400/10 p-2 rounded-lg border border-emerald-400/20">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span class="text-xs font-bold uppercase tracking-tighter">En cours de prêt</span>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="mt-20 border-t border-white/5 py-10 text-center opacity-50">
        <p class="text-xs uppercase tracking-[0.5em]">Administration MyLibrary — 2025</p>
    </footer>

</body>
</html>