<?php
include_once __DIR__ . "/../controllers/Auth.php";
include_once __DIR__ . "/../controllers/AdminMeth.php";
include_once __DIR__ . "/../controllers/books.php";
include_once __DIR__ . "/../controllers/ReaderMetho.php";

if (!isset($_SESSION['borrows'])) {
    $_SESSION['borrows'] = [];
}

$bookModel = new Book($conn);
$books = $_SESSION['books'] ?? [];
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Liste des Livres — MyLibrary</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .book-card { background: #141618; border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; }
        .book-card:hover { border-color: #6139B4; transform: translateY(-5px); }
    </style>
</head>

<body class="bg-[#0f1113] text-[#F2F5F3] flex flex-col min-h-screen">
<?php if($user): ?>
    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold tracking-tight">My<span class="gradient-text">Library</span></h1>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm uppercase font-bold text-gray-400">
                <a href="/home" class="text-[#a78bfa] font-bold border-b-2 border-[#6139B4] pb-1 transition-colors">Accueil</a>
                <a href="/service" class="hover:text-white font-bold uppercase transition-colors">Services</a>
                <a href="/allbooks" class="hover:text-white transition">ALL BOOKS</a>
                <a href="/profile" class="hover:text-white font-bold uppercase transition-colors">Profil</a>
                <?php if($user['role'] === 'reader'): ?>
                    <a href="/book" class="hover:text-white transition-colors font-bold uppercase tracking-wider text-xs">LIVRES</a>
                    <a href="/reserved" class="hover:text-white transition-colors font-bold uppercase tracking-wider text-xs">Réservations</a>
                <?php elseif($user['role'] === 'admin'): ?>
                    <a href="/dashboard" class="hover:text-white font-bold transition-colors">Dashboard</a>
                    <a href="/reserveadmin" class="hover:text-white font-bold transition-colors uppercase tracking-wider text-xs">Réservations</a>
                    <a href="/allusers" class="hover:text-white font-bold transition-colors">Users</a>
                <?php endif; ?>
            </nav>
            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-gray-400">Bienvenue,</p>
                    <p class="text-sm font-semibold"><?= htmlspecialchars($user['firstname']); ?></p>
                </div>
                <img src="<?= htmlspecialchars($user['avatar_url']); ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="avatar">
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
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex-1">
                <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span></h1>
            </div>
            <nav class="hidden md:flex flex-1 justify-center items-center gap-10 text-sm font-semibold tracking-wide uppercase">
                <a href="/home" class="text-white hover:text-[#a78bfa] transition-colors">Accueil</a>
                <a href="/service" class="text-gray-400 hover:text-white transition-colors">Services</a>
                <a href="/allbooks" class="hover:text-white transition-colors uppercase">
                All Books
                </a>            
            </nav>
            <div class="flex-1 flex justify-end">
                <a href="/formulaire" class="px-7 py-3 rounded-full bg-white text-black text-xs font-black uppercase tracking-tighter hover:bg-[#a78bfa] hover:text-white transition-all shadow-xl shadow-white/5 active:scale-95">
                    Connexion
                </a>
            </div>
        </div>
    </header>
<?php endif; ?>

    <main class="max-w-7xl mx-auto px-6 py-12 w-full">
        <div class="mb-12">
            <h2 class="text-4xl font-bold tracking-tight italic">Liste des <span class="gradient-text">Livres</span></h2>
            <p class="text-gray-400 mt-2 italic text-sm underline decoration-[#6139B4]">Parcourez notre catalogue complet.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php foreach ($books as $book): ?>
            <?php
                $userBorrows = [];
                $isOwner = false;

                if ($user && $user['role'] === 'reader') {
                    $userBorrows = $bookModel->isAvailable($user['id']); 
                    foreach ($userBorrows as $borrow) {
                        if ($borrow['book_id'] == $book->get_book_id()) {
                            $isOwner = true; 
                            break;
                        }
                    }
                }
    ?>
                <div class="book-card rounded-3xl p-6 shadow-xl flex flex-col justify-between group">
                    
                    <div class="relative mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#6139B4]/10 flex items-center justify-center text-[#a78bfa] mb-4">
                            <i class="fa-solid fa-book text-xl"></i>
                        </div>

                        <h3 class="text-xl font-bold text-white group-hover:text-[#a78bfa] transition leading-tight h-14 overflow-hidden">
                            <?= htmlspecialchars($book->get_title()) ?>
                        </h3>

                        <p class="text-sm text-gray-400 mt-2 flex items-center gap-2">
                            <i class="fa-solid fa-pen-nib w-4 text-[#6139B4]"></i> 
                            <?= htmlspecialchars($book->get_author()) ?>
                        </p>
                    </div>
                    <form method="POST" class="space-y-4">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold uppercase text-gray-500 italic px-1">Début</label>
                                <input type="date" name="startdate" class="w-full bg-white/5 border border-white/10 rounded-xl p-2 text-xs text-white focus:border-[#6139B4] outline-none" required>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold uppercase text-gray-500 italic px-1">Fin</label>
                                <input type="date" name="enddate" class="w-full bg-white/5 border border-white/10 rounded-xl p-2 text-xs text-white focus:border-[#6139B4] outline-none" required>
                            </div>
                            </div>
                            <div class="mt-6">
                                <?php if ($user && $user['role'] === 'reader'): ?>
                                    <?php if ($book->get_status() === "available"): ?>
                                        <button type="submit" name="book" value="<?= $book->get_book_id(); ?>" class="w-full py-3 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] text-white font-bold text-sm transition shadow-lg shadow-[#6139B4]/20 flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-bookmark"></i> Emprunter
                                        </button>

                                    <?php elseif ($isOwner): ?>
                                        <form method="POST">
                                            <button type="submit" name="removebtn" value="<?= $book->get_book_id(); ?>" class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-sm transition shadow-lg flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-trash-can"></i> Annuler l'emprunt
                                            </button>
                                        </form>

                                    <?php else: ?>
                                        <button type="button" class="w-full py-3 rounded-xl bg-gray-800 text-gray-500 font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2" disabled>
                                            <i class="fa-solid fa-ban"></i> Indisponible
                                        </button>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <a href="/formulaire" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 text-white font-bold text-sm transition flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-user-lock"></i> Se connecter
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="mt-auto border-t border-white/5 bg-[#0f1113] py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-500 text-sm italic">
                © 2025 <span class="text-white font-semibold">MyLibrary</span> — Design System Tailwind.
            </p>
        </div>
    </footer>

</body>
</html>