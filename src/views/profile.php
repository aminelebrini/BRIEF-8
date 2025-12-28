<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    
    if(!isset($_SESSION['user']))
    {
        header("Location : /home");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-[#1B1B1E] text-[#F2F5F3]">
<?php if(isset($_SESSION['user'])): ?>
    <?php if($_SESSION['user']['role'] === 'reader'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>

                <nav class="flex gap-4 text-sm">
                    <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                    <a href="/service" class="hover:text-[#6139B4]">Services</a>
                    <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                    <a href="/book" class="hover:text-[#6139B4]">BOOKS</a>
                    <a href="/reserved" class="hover:text-[#6139B4]">RESERVATIONS</a>
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $_SESSION['user']['firstname']; ?></span>
                    <form method="POST">
                        <button type="submit" name="logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</button>
                    </form>
                </div>
            </div>
        </header>

    <?php elseif($_SESSION['user']['role'] === 'admin'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>

                <nav class="flex gap-4 text-sm">
                    <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                    <a href="/service" class="hover:text-[#6139B4]">Services</a>
                    <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                    <a href="/dashboard" class="hover:text-[#6139B4]">Dashboard</a>
                    <a href="/reserveadmin" class="hover:text-[#6139B4]">RESERVATIONS</a>
                    <a href="/users" class="hover:text-[#6139B4]">Gestion Users</a>
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $_SESSION['user']['firstname']; ?></span>
                    <form method="POST">
                        <button type="submit" name="logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</button>
                    </form>
                </div>
            </div>
        </header>        
    <?php endif; ?>
<?php else: ?>
    <header class="w-full bg-[#141618] border-b border-[#17181B]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">📚 MyLibrary</h1>
            <nav class="flex gap-4 text-sm">
                <a href="/formulaire" class="hover:text-[#6139B4]">Connexion</a>
            </nav>
        </div>
    </header>
<?php endif; ?>
<main class="max-w-5xl mx-auto p-6 mt-10">
    <div class="bg-[#141618] border border-[#17181B] rounded-3xl p-8 shadow-xl flex flex-col gap-6">
        
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-full bg-[#26282C] flex items-center justify-center text-white text-2xl font-bold">
                <?= strtoupper(substr($_SESSION['user']['firstname'],0,1)) ?>
            </div>

            <div class="flex flex-col gap-1">
                <h2 class="text-3xl font-bold text-[#9F8BFF]">
                    <?= htmlspecialchars($_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']) ?>
                </h2>
                <span class="text-gray-400 uppercase text-sm tracking-wide">
                    <?= htmlspecialchars($_SESSION['user']['role']) ?>
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 text-gray-300">
            <div class="bg-[#1F1F22] rounded-xl p-4 flex flex-col gap-1 hover:bg-[#26282C] transition">
                <span class="text-white font-medium">Email</span>
                <span><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
            </div>

            <div class="bg-[#1F1F22] rounded-xl p-4 flex flex-col gap-1 hover:bg-[#26282C] transition">
                <span class="text-white font-medium">Role</span>
                <span><?= htmlspecialchars($_SESSION['user']['role']) ?></span>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="/books" class="px-6 py-2 rounded-xl bg-[#7C5CFF] hover:bg-[#6139B4] text-white font-semibold transition">
                Voir Livres
            </a>
            <a href="/reserved" class="px-6 py-2 rounded-xl border border-[#7C5CFF] hover:bg-[#7C5CFF] hover:text-white text-[#7C5CFF] font-semibold transition">
                Mes Réservations
            </a>
        </div>

    </div>
</main>

</body>
</html>