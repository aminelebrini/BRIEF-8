<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";
    include_once __DIR__ . "/../controllers/ReaderMetho.php";

    $User = $_SESSION['user'] ?? null;
    $BooksRes = $readerMeth->affAllReservation();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Mes Réservations — MyLibrary</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen">

    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'reader'): ?>
        <header class="sticky top-0 z-50 glass border-b border-white/5">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold tracking-tight">My<span class="gradient-text">Library</span></h1>
                </div>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
                    <a href="/home" class="hover:text-white transition-colors">Accueil</a>
                    <a href="/service" class="hover:text-white transition-colors">Services</a>
                    <a href="/profile" class="hover:text-white transition-colors">Profil</a>
                    <a href="/books" class="hover:text-white transition-colors uppercase tracking-wider text-xs font-bold">Books</a>
                    <a href="/reserved" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1 uppercase tracking-wider text-xs font-bold">Réservations</a>
                </nav>

                <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs text-gray-400">Bienvenue,</p>
                        <p class="text-sm font-semibold"><?= $_SESSION['user']['firstname']; ?></p>
                    </div>
                    <img src="<?= $_SESSION['user']['avatar_url'] ?>" class="w-10 h-10 rounded-full border-2 border-[#6139B4] object-cover" alt="user">
                    <form method="POST">
                        <button type="submit" name="logout" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>
    <?php endif; ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <h2 class="text-3xl font-bold tracking-tight italic md:not-italic">
                <i class="fa-solid fa-bookmark text-[#6139B4] mr-2"></i>
                Your <span class="gradient-text">Reservations</span>
            </h2>
            
            <form method="POST">
                <button type="submit" name="show" id="affbtn" class="flex items-center gap-2 px-6 py-3 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] text-white font-bold transition shadow-lg shadow-[#6139B4]/20">
                    <i class="fa-solid fa-list-check"></i>
                    Show All
                </button>
            </form>
        </div>

        <div class="listreservation hidden w-full">
            
            <?php if(empty($BooksRes)): ?>
                <div class="w-full py-20 bg-[#141618] border-2 border-dashed border-white/5 rounded-3xl flex flex-col items-center">
                    <i class="fa-solid fa-box-open text-5xl text-gray-700 mb-4"></i>
                    <h1 class="text-center text-2xl text-gray-500">The Borrowing list is Empty</h1>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($BooksRes as $Res): ?>
                        <div class="relative bg-[#141618] border border-white/5 rounded-2xl p-6 shadow-xl hover:border-[#6139B4]/50 transition-all group">
                            
                            <span class="absolute left-0 top-6 bottom-6 w-[4px] rounded-r-full bg-[#6139B4] shadow-[0_0_10px_#6139B4]"></span>

                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-xl font-bold text-white group-hover:text-[#a78bfa] transition-colors leading-tight">
                                    <?= htmlspecialchars($Res['title']) ?>
                                </h2>
                                <span class="text-[10px] text-gray-500 font-mono">#<?= htmlspecialchars($Res['book_id']) ?></span>
                            </div>

                            <div class="space-y-3 mb-8">
                                <p class="flex items-center text-gray-400 text-sm">
                                    <i class="fa-solid fa-user-nib w-6 text-[#6139B4]"></i>
                                    Auteur : <span class="ml-2 text-white font-medium"><?= htmlspecialchars($Res['author']) ?></span>
                                </p>
                                <p class="flex items-center text-gray-400 text-sm">
                                    <i class="fa-solid fa-calendar-day w-6 text-[#6139B4]"></i>
                                    Année : <span class="ml-2 text-white font-medium"><?= htmlspecialchars($Res['publication_year']) ?></span>
                                </p>
                                <p class="flex items-center text-gray-400 text-sm">
                                    <i class="fa-solid fa-barcode w-6 text-[#6139B4]"></i>
                                    Book ID : <span class="ml-2 text-[#a78bfa] font-bold"><?= htmlspecialchars($Res['book_id']) ?></span>
                                </p>
                            </div>

                            <form method="POST" class="mt-auto">
                                <button type="submit" name="removebtn" value="<?= $Res['book_id'] ?>" 
                                        class="w-full py-3 rounded-xl border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white font-bold transition-all text-sm flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <script>
        const affdiv = document.querySelector('.listreservation');
        const affbtn = document.getElementById('affbtn');
        if(affbtn) {
            affbtn.addEventListener('click', (e) => {
                e.preventDefault();
                affdiv.classList.remove('hidden');
            });
        }
    </script>
</body>
</html>