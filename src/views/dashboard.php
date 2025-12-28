<?php
  include_once __DIR__ . "/../controllers/Auth.php";
  include_once __DIR__ . "/../controllers/AdminMeth.php";
  include_once __DIR__ . "/../controllers/books.php";

  $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Admin Dashboard — MyLibrary</title>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(20, 22, 24, 0.7); backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-admin { background: #141618; border: 1px border-white/5; transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-[#0f1113] text-[#F2F5F3] min-h-screen">

<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <header class="sticky top-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight italic">My<span class="gradient-text">Library</span> Admin</h1>

            <nav class="hidden md:flex gap-6 text-xs font-bold uppercase tracking-widest text-gray-400">
                <a href="/home" class="hover:text-white transition">Accueil</a>
                <a href="/service" class="hover:text-white transition">Services</a>
                <a href="/profile" class="hover:text-white transition">Profile</a>
                <a href="/dashboard" class="text-[#a78bfa] border-b-2 border-[#6139B4] pb-1">Dashboard</a>
                <a href="/reserveadmin" class="hover:text-white transition">RESERVATIONS</a>
                <a href="/allusers" class="hover:text-white transition">Gestion Users</a>
            </nav>

            <div class="flex gap-4 items-center pl-6 border-l border-white/10">
                <span class="text-sm font-semibold hidden sm:block"><?= $_SESSION['user']['firstname']; ?></span>
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

<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-8 italic">Gestion du <span class="gradient-text">Catalogue</span></h2>
        <div class="flex flex-wrap justify-center gap-4">
            <button type="button" id="addbtn" class="group flex items-center gap-3 px-8 py-4 rounded-2xl bg-[#6139B4]/10 border border-[#6139B4]/30 text-[#a78bfa] hover:bg-[#6139B4] hover:text-white hover:border-[#6139B4] transition-all duration-300 font-bold uppercase tracking-widest text-xs shadow-lg shadow-[#6139B4]/5 hover:shadow-[#6139B4]/40 hover:-translate-y-1 active:scale-95">
              <i class="fa-solid fa-plus text-base transition-transform duration-500 group-hover:rotate-180"></i> 
              <span>Add Book</span>
            </button>
            <button type="button" id="rmbtn" class="flex items-center gap-2 px-6 py-3 rounded-xl bg-red-600/10 border border-red-600/20 text-red-500 hover:bg-red-600 hover:text-white transition font-bold">
                <i class="fa-solid fa-trash-can"></i> REMOVE BOOK
            </button>
            <button type="button" id="updatebtn" class="flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600/10 border border-emerald-600/20 text-emerald-500 hover:bg-emerald-600 hover:text-white transition font-bold">
                <i class="fa-solid fa-pen-to-square"></i> UPDATE BOOK
            </button>
        </div>
    </div>

    <div class="relative max-w-xl mx-auto">
        
        <div class="adddiv hidden card-admin p-8 rounded-[2rem] shadow-2xl border border-[#6139B4]/30">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                <i class="fa-solid fa-circle-plus text-[#a78bfa]"></i> Ajouter un livre
            </h2>
            <form method="POST" class="space-y-4">
                <input type="text" name="title" placeholder="Titre du livre" class="w-full p-4 rounded-xl bg-white/5 border border-white/10 focus:border-[#6139B4] transition outline-none" required>
                <input type="text" name="author" placeholder="Auteur" class="w-full p-4 rounded-xl bg-white/5 border border-white/10 focus:border-[#6139B4] transition outline-none" required>
                <input type="number" name="publication_year" placeholder="Année de publication" class="w-full p-4 rounded-xl bg-white/5 border border-white/10 focus:border-[#6139B4] transition outline-none" required>
                <button type="submit" name="addbook" class="w-full p-4 rounded-xl bg-[#6139B4] hover:bg-[#4f2d91] font-bold transition shadow-lg shadow-[#6139B4]/20">
                    Enregistrer l'ouvrage
                </button>
            </form>
        </div>

        <div class="removediv hidden card-admin p-8 rounded-[2rem] shadow-2xl border border-red-600/30">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-3 text-red-500">
                <i class="fa-solid fa-eraser"></i> Supprimer un livre
            </h2>
            <form method="POST" class="space-y-4">
                <div class="bg-red-500/5 p-4 rounded-xl border border-red-500/10 text-xs text-red-400 mb-4 italic">
                    <i class="fa-solid fa-circle-info mr-1"></i> Attention, cette action est irréversible.
                </div>
                <input type="text" name="book_id" placeholder="ID unique du livre (ex: BK-001)" class="w-full p-4 rounded-xl bg-white/5 border border-white/10 focus:border-red-600 transition outline-none text-red-400" required>
                <button type="submit" name="removebook" class="w-full p-4 rounded-xl bg-red-600 hover:bg-red-700 font-bold transition">
                    Supprimer définitivement
                </button>
            </form>
        </div>

        <div class="update hidden card-admin p-8 rounded-[2rem] shadow-2xl border border-emerald-600/30">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-3 text-emerald-500">
                <i class="fa-solid fa-pen-nib"></i> Éditer un ouvrage
            </h2>
            <form method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block mb-2 text-xs font-bold text-gray-500 uppercase italic">ID du livre à modifier</label>
                        <input type="text" name="book_id" class="w-full p-3 rounded-xl bg-white/5 border border-emerald-600/30 text-emerald-400 font-bold outline-none" placeholder="ID obligatoire" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold text-gray-400 italic">Nouveau Titre</label>
                        <input type="text" name="title" class="w-full p-3 rounded-xl bg-white/5 border border-white/10 outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-bold text-gray-400 italic">Nouvel Auteur</label>
                        <input type="text" name="author" class="w-full p-3 rounded-xl bg-white/5 border border-white/10 outline-none" required>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-xs font-bold text-gray-400 italic">Nouvelle Année</label>
                        <input type="number" name="year" class="w-full p-3 rounded-xl bg-white/5 border border-white/10 outline-none" required>
                    </div>
                </div>
                <button type="submit" name="update" class="w-full p-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 font-bold transition">
                    Appliquer les modifications
                </button>
            </form>
        </div>

    </div>
</main>

<script>
    const AddDiv = document.querySelector('.adddiv');
    const RemoveDiv = document.querySelector('.removediv');
    const UpdateDiv = document.querySelector('.update');
    const addBtn = document.getElementById('addbtn');
    const removeBtn = document.getElementById('rmbtn');
    const updateBtn = document.getElementById('updatebtn');

    function hideAll() {
        AddDiv.classList.add('hidden');
        RemoveDiv.classList.add('hidden');
        UpdateDiv.classList.add('hidden');
    }

    if (addBtn) {
        addBtn.addEventListener('click', () => {
            hideAll();
            AddDiv.classList.remove('hidden');
        });
    }

    if (removeBtn) {
        removeBtn.addEventListener('click', () => {
            hideAll();
            RemoveDiv.classList.remove('hidden');
        });
    }

    if (updateBtn) {
        updateBtn.addEventListener('click', () => {
            hideAll();
            UpdateDiv.classList.remove('hidden');
        });
    }
</script>
</body>
</html>