<?php   
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";


    $User = $_SESSION['user'] ?? null;
    $Books = $_SESSION['books'] ?? [];    
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
    <?php if($_SESSION['user']['role'] === 'reader'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>

                <nav class="flex gap-4 text-sm">
                    <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                    <a href="/service" class="hover:text-[#6139B4]">Services</a>
                    <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                    <a href="/books" class="hover:text-[#6139B4]">BOOKS</a>
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $_SESSION['user']['firstname']; ?></span>
                    <form method="POST">
                        <button type="submit" name="logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <? endif; ?>
    <div class="books grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 py-8">
    <?php foreach($Books as $book): ?>
        <div class="bg-[#141618] border border-[#17181B] rounded-2xl shadow-lg p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
            <h2 class="text-xl font-semibold text-[#F2F5F3] mb-2"><?= htmlspecialchars($book->get_title()) ?></h2>
            <p class="text-[#F2F5F3]/70 mb-1">Auteur : <?= htmlspecialchars($book->get_author()) ?></p>
            <p class="text-[#F2F5F3]/70 mb-1">Année : <?= htmlspecialchars($book->get_year()) ?></p>
            <p class="text-[#F2F5F3]/70 mb-4">
                Statut : 
                <?php if($book->get_status() === 'available'): ?>
                    <span class="font-semibold text-green-400">available</span>
                <?php else: ?>
                    <span class="font-semibold text-red-400">unavailable</span>
                <?php endif; ?>
            </p>
            <a href="#"
               class="inline-block px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white text-sm font-medium transition">
                Emprunter
            </a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>