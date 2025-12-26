<?php
      include_once __DIR__ . "/../controllers/logincontrollers.php";
    include_once __DIR__ . "/../controllers/signupcontroller.php";
    
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
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $_SESSION['user']['firstname']; ?></span>
                    <button type="submit" name="logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</button>
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
                    <a href="/service" class="hover:text-[#6139B4]">Admin Panel</a>
                    <a href="/users" class="hover:text-[#6139B4]">Gestion Users</a>
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $_SESSION['user']['firstname']; ?></span>
                    <a href="?page=logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</a>
                </div>
            </div>
        </header>        
    <?php endif; ?>
<?php else: ?>
    <header class="w-full bg-[#141618] border-b border-[#17181B]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">📚 MyLibrary</h1>
            <nav class="flex gap-4 text-sm">
                <a href="?page=login" class="hover:text-[#6139B4]">Connexion</a>
                <a href="?page=signup" class="hover:text-[#6139B4]">Inscription</a>
            </nav>
        </div>
    </header>
<?php endif; ?>
</body>
</html>