<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";

    $AllRese = $adminbook->display_all_reservation();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>RESERVATIONS LIST</title>
</head>
<body  class="bg-[#1B1B1E] text-[#F2F5F3]">
<?php if($_SESSION['user']['role'] === 'admin'): ?>
    <header class="w-full bg-[#141618] border-b border-[#17181B]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">📚 MyLibrary</h1>
            <nav class="flex gap-4 text-sm">
                <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                <a href="/service" class="hover:text-[#6139B4]">Services</a>
                <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                <a href="/dashboard" class="hover:text-[#6139B4]">Dashboard</a>
                <a href="/reserveadmin" class="hover:text-[#6139B4]">RESERVATIONS</a>
                <a href="/allusers" class="hover:text-[#6139B4]">Gestion Users</a>
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
    <div class="max-w-7xl mx-auto px-6 py-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach($AllRese as $res): ?>
        <div class="bg-[#141618] border border-[#17181B] rounded-2xl shadow-lg p-6 flex flex-col gap-3 transition hover:shadow-2xl hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-white"><?= htmlspecialchars($res['title']) ?></h2>
            <p class="text-sm text-gray-300">
                Auteur : <span class="text-white"><?= htmlspecialchars($res['author']) ?></span>
            </p>
            <p class="text-sm text-gray-300">
                Réservé par : <span class="text-white"><?= htmlspecialchars($res['firstname'] . ' ' . $res['lastname']) ?></span>
            </p>
            <p class="text-sm text-gray-300">
                Date de réservation : <span class="text-white"><?= htmlspecialchars($res['borrow_date']) ?></span>
            </p>
            <p class="text-sm text-gray-300">
                Date de Retour : <span class="text-white"><?= htmlspecialchars($res['return_date']) ?></span>
            </p>
            <?php 
                $today = new DateTime();
                $returnedDate = new DateTime($res['return_date']);

                if ($today > $returnedDate): ?>
                    <p class="text-sm text-red-500">À retourner immédiatement !</p>
                <?php else: ?>
                    <p class="text-sm text-green-500">Pas encore à retourner</p>
                <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>       
</body>
</html>