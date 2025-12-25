<?php
include_once __DIR__ . "/../data/user.php";
$User = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyLibrary — Services</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1B1B1E] text-[#F2F5F3]">

<?php if($User): ?>
    <?php if($User['role'] === 'reader'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>
                <nav class="flex gap-4 text-sm">
                    <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                    <a href="/service" class="hover:text-[#6139B4]">Services</a>
                    <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                </nav>
                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $User['firstname']; ?></span>
                    <a href="?page=logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</a>
                </div>
            </div>
        </header>

    <?php elseif($User['role'] === 'admin'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>
                <nav class="flex gap-4 text-sm">
                    <a href="?page=dashboard" class="hover:text-[#6139B4]">Dashboard</a>
                    <a href="?page=service" class="hover:text-[#6139B4]">Admin Panel</a>
                    <a href="?page=users" class="hover:text-[#6139B4]">Gestion Users</a>
                </nav>
                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= $User['firstname']; ?></span>
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
<section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos Services</h2>
      <p class="text-[#F2F5F3]/70 mb-6">
        Découvrez tous les services disponibles pour les lecteurs et le personnel :
        gestion des livres, suivi des emprunts, et bien plus.
      </p>

      <div class="flex gap-4">
        <a href="?page=login" class="px-6 py-3 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">
          Commencer
        </a>
        <a href="#features" class="px-6 py-3 rounded-lg border border-[#17181B] hover:bg-[#17181B]">
          En savoir plus
        </a>
      </div>
    </div>

    <div class="bg-[#141618] border border-[#17181B] rounded-2xl p-6">
      <p class="text-sm opacity-80 mb-4">Pourquoi MyLibrary ?</p>
      <ul class="space-y-3 text-sm">
        <li class="flex justify-between"><span>✔ Gestion simple des livres</span></li>
        <li class="flex justify-between"><span>✔ Suivi des emprunts</span></li>
        <li class="flex justify-between"><span>✔ Accès rapide aux ressources</span></li>
        <li class="flex justify-between"><span>✔ Interface moderne et claire</span></li>
      </ul>
    </div>
</section>
<footer class="border-t border-[#17181B] bg-[#141618] py-6 text-center text-sm">
    © 2025 MyLibrary — Tous droits réservés
</footer>

</body>
</html>
