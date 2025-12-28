<?php
  include_once __DIR__ . "/../controllers/Auth.php";

$_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyLibrary — Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1B1B1E] text-[#F2F5F3]">
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
    <div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-white mb-8">All Users</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        
        <div class="bg-[#141618] border border-[#17181B] rounded-2xl shadow-lg overflow-hidden flex flex-col transition hover:shadow-2xl hover:-translate-y-1">
            <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                <img src="/images/default-avatar.png" alt="Avatar" class="object-cover w-full h-full">
            </div>
            <div class="p-6 flex flex-col gap-3">
                <h2 class="text-xl font-semibold text-white">Nom Prénom</h2>
                <p class="text-gray-300"><strong>Email:</strong> <span class="text-white">email@example.com</span></p>
                <p class="text-gray-300"><strong>Role:</strong> <span class="text-white">Reader/Admin</span></p>
                <div class="mt-4 flex gap-2">
                    <button class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white w-full">Edit</button>
                    <button class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white w-full">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>