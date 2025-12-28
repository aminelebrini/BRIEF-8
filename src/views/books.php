<?php
include_once __DIR__ . "/../controllers/Auth.php";
include_once __DIR__ . "/../controllers/AdminMeth.php";
include_once __DIR__ . "/../controllers/books.php";
include_once __DIR__ . "/../controllers/ReaderMetho.php";

$User = $_SESSION['user'] ?? null;
$Books = $_SESSION['books'] ?? [];

if (!isset($_SESSION['borrows'])) {
    $_SESSION['borrows'] = [];
}

$bookModel = new Book($conn);
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Catalogue — MyLibrary</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(20, 22, 24, 0.7);
            backdrop-filter: blur(12px);
        }

        .gradient-text {
            background: linear-gradient(135deg, #a78bfa, #6139B4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .book-card {
            background: #141618;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .book-card:hover {
            border-color: #6139B4;
            transform: translateY(-5px);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
</head>

<body class="bg-[#0f1113] text-[#F2F5F3] selection:bg-[#6139B4] flex flex-col min-h-screen">

    <?php if ($User && $User['role'] === 'reader'): ?>
        <header class="sticky top-0 z-50 glass border-b border-white/5">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span></h1>

                <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-gray-400">
                    <a href="/home" class="hover:text-white transition">Accueil</a>
                    <a href="/service" class="hover:text-white transition">Services</a>
                    <a href="/allbooks" class="hover:text-white transition">ALL BOOKS</a>
                    <a href="/profile" class="hover:text-white transition">Profil</a>
                    <a href="/books" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Books</a>
                    <a href="/reserved" class="hover:text-white transition">Réservations</a>
                </nav>

                <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs text-gray-400">Bienvenue,</p>
                        <p class="text-sm font-semibold"><?= htmlspecialchars($User['firstname']); ?></p>
                    </div>
                    <img src="<?= htmlspecialchars($User['avatar_url']) ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="user">
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
        <div class="mb-12">
            <h2 class="text-4xl font-bold tracking-tight italic">Explorez notre <span class="gradient-text">Collection</span></h2>
            <p class="text-gray-400 mt-2 italic text-sm underline decoration-[#6139B4]">Trouvez votre prochaine aventure littéraire.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php foreach ($Books as $book):
                $userBorrows = $bookModel->isAvailable($User['id']);
                $isOwner = false;
                foreach ($userBorrows as $borrow) {
                    if ($borrow['book_id'] == $book->get_book_id()) {
                        $isOwner = true;
                        break;
                    }
                }
            ?>
                <div class="book-card rounded-3xl p-6 shadow-xl flex flex-col justify-between group">

                    <div class="relative mb-4">
                        <div class="flex justify-between items-start">
                            <div class="w-12 h-12 rounded-2xl bg-[#6139B4]/10 flex items-center justify-center text-[#a78bfa] mb-4">
                                <i class="fa-solid fa-book text-xl"></i>
                            </div>
                            <span class="text-[10px] font-mono text-gray-600 bg-black/30 px-2 py-1 rounded">#<?= htmlspecialchars($book->get_book_id()) ?></span>
                        </div>

                        <h2 class="text-xl font-bold text-white group-hover:text-[#a78bfa] transition leading-tight h-14 overflow-hidden">
                            <?= htmlspecialchars($book->get_title()) ?>
                        </h2>

                        <div class="space-y-2 mt-4">
                            <p class="text-xs text-gray-400 flex items-center gap-2">
                                <i class="fa-solid fa-pen-nib w-4"></i> <?= htmlspecialchars($book->get_author()) ?>
                            </p>
                            <p class="text-xs text-gray-400 flex items-center gap-2">
                                <i class="fa-solid fa-calendar w-4"></i> <?= htmlspecialchars($book->get_year()) ?>
                            </p>
                            <p class="text-xs flex items-center gap-2">
                                <i class="fa-solid fa-circle-info w-4"></i>
                                Status : <span class="<?= $book->get_status() === 'available' ? 'text-emerald-400 font-bold' : 'text-red-400' ?>">
                                    <?= ucfirst(htmlspecialchars($book->get_status())) ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <?php if ($book->get_status() === "available"): ?>
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
                                <button type="submit" name="book" value="<?= $book->get_book_id(); ?>" class="w-full py-3 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] text-white font-bold text-sm transition shadow-lg shadow-[#6139B4]/20 flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bookmark"></i> Emprunter
                                </button>
                            </form>

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