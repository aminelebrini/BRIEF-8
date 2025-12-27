<?php
  include_once __DIR__ . "/../controllers/Auth.php";
  include_once __DIR__ . "/../controllers/AdminMeth.php";
  include_once __DIR__ . "/../controllers/books.php";

$User = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>
<body  class="bg-[#1B1B1E] text-[#F2F5F3]">
    <?php if($User && $User['role'] === 'admin'): ?>
        <header class="w-full bg-[#141618] border-b border-[#17181B]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">📚 MyLibrary</h1>

                <nav class="flex gap-4 text-sm">
                    <a href="/home" class="hover:text-[#6139B4]">Accueil</a>
                    <a href="/service" class="hover:text-[#6139B4]">Services</a>
                    <a href="/profile" class="hover:text-[#6139B4]">Profile</a>
                    <a href="/dashboard" class="hover:text-[#6139B4]">Dashboard</a>
                    <a href="/users" class="hover:text-[#6139B4]">Gestion Users</a>
                </nav>

                <div class="flex gap-3 items-center">
                    <span class="text-sm text-white"><?= htmlspecialchars($User['firstname']); ?></span>
                    <form method="POST">
                        <button type="submit" name="logout" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91]">Logout</button>
                    </form>
                </div>
            </div>
        </header>
    <? else:?>
    <?php endif; ?>
    <div class="flex flex-row w-full items-center justify-evenly">
        <div class="flex justify-center gap-4 mt-6">
            <button type="button" name="addbook" id="addbtn" class="px-6 py-3 rounded-xl bg-[#6139B4] text-white font-semibold hover:bg-[#4e2f95] transition shadow-md">ADD BOOK</button>
            <button type="button" name="removebook" id="rmbtn" class="px-6 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow-md">REMOVE BOOK</button>
        </div>
    </div>
    <div class="adddiv hidden max-w-md mx-auto mt-10 bg-[#141618] border border-[#1f2124] p-6 rounded-2xl shadow-lg">
    <h2 class="text-xl font-semibold mb-4">Ajouter un livre</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="title" placeholder="Title" class="w-full p-3 rounded-xl bg-[#1B1B1E] border border-[#2a2c31] focus:outline-none focus:border-[#6139B4]"required>
    <input 
      type="text" 
      name="author" 
      placeholder="Author"
      class="w-full p-3 rounded-xl bg-[#1B1B1E] border border-[#2a2c31] focus:outline-none focus:border-[#6139B4]"
      required>

    <input 
      type="text" 
      name="publication_year" 
      placeholder="Year"
      class="w-full p-3 rounded-xl bg-[#1B1B1E] border border-[#2a2c31] focus:outline-none focus:border-[#6139B4]"
      required>

    <button 
      type="submit" 
      name="addbook"
      class="w-full p-3 rounded-xl bg-[#6139B4] hover:bg-[#4e2f95] transition">
      Save
    </button>
  </form>
</div>

<div class="removediv hidden max-w-md mx-auto mt-10 bg-[#141618] border border-[#1f2124] p-6 rounded-2xl shadow-lg">
  <h2 class="text-xl font-semibold mb-4">Supprimer un livre</h2>

  <form method="POST" class="space-y-4">

    <input 
      type="text" 
      name="book_id" 
      placeholder="Book TITLE"
      class="w-full p-3 rounded-xl bg-[#1B1B1E] border border-[#2a2c31] focus:outline-none focus:border-[#6139B4]"
      required>

    <button 
      type="submit" 
      name="removebook"
      class="w-full p-3 rounded-xl bg-red-600 hover:bg-red-700 transition">
      Delete
    </button>

  </form>
</div>


<script>
    const AddDiv = document.querySelector('.adddiv');
    const RemoveDive = document.querySelector('.removediv');
    const addBtn = document.getElementById('addbtn');
    const removeBtn = document.getElementById('rmbtn');


    if(addBtn)
    {
        addBtn.addEventListener('click', ()=>{
        AddDiv.classList.remove('hidden');
        RemoveDive.classList.add('hidden');
    });
  }

  if(removeBtn)
  {
    removeBtn.addEventListener('click', ()=>{
      AddDiv.classList.add('hidden');
      RemoveDive.classList.remove('hidden');
    });
  }
</script>
</body>
</html>