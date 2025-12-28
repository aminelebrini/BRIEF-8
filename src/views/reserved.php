<?php

    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";
    include_once __DIR__ . "/../controllers/ReaderMetho.php";

    $User = $_SESSION['user'] ?? null;

    $BooksRes = $readerMeth->affAllReservation();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>RESERVED BOOK</title>
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
        <? endif; ?>

        <div class="display w-full h-auto flex flex-col items-center justify-start mt-10 gap-15">
            <h1 class="text-[30px] font-bold">Your Reservations</h1>
            <div class="btnresr w-[95%] flex flex-row items-center justify-start">
                <form method="POST">
                    <button type="submit" name="show" id="affbtn" class="px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white font-medium transition">
                        Show All
                    </button>
                </form>
            </div>
            <div class="listreservation hidden gap-5 flex flex-row items-center justify-start">
                <?php if(empty($BooksRes)): ?>
                    <div class="w-full h-screen">
                        <h1 class="text-center text-[34px]">The Borrowing list is Empty</h1>
                    </div>
                <?php endif; ?>
                <?php foreach ($BooksRes as $Res): ?>
                    <div class="relative mt-10 bg-[#141618] border border-[#1f2124] rounded-2xl p-6 shadow-lg hover:shadow-xl transition flex flex-col items-start justify-evenly gap-15 w-full">

                        <span class="absolute left-0 top-0 h-full w-[4px] rounded-l-2xl bg-[#7C5CFF]"></span>

                            <h2 class="text-[25px] font-semibold text-white mb-2">
                                <?= htmlspecialchars($Res['title']) ?>
                            </h2>

                            <div class="space-y-1 text-sm">

                                <p class="text-gray-300 text-[20px]">
                                    Auteur :
                                <span class="text-white font-medium">
                                    <?= htmlspecialchars($Res['author']) ?>
                                </span>
                                </p>
                                <p class="text-gray-300 text-[20px]">
                                Année :
                                <span class="text-white font-medium">
                                    <?= htmlspecialchars($Res['publication_year']) ?>
                                </span>
                                </p>

                                <p class="text-gray-300 text-[20px]">
                                    Book ID :
                                <span class="text-[#9F8BFF] font-semibold">
                                <?= htmlspecialchars($Res['book_id']) ?>
                                </span>
                                </p>
                            </div>
                            <form method="POST" class="mt-5">
                                <button type="submit" name="removebtn" value="<?= $Res['book_id'] ?>" class="w-[150px] py-2.5 rounded-xl border border-red-700 text-red-400 hover:bg-red-600 hover:text-white font-medium transition"> Supprimer</button>
                            </form>
                        </div>

                <?php endforeach; ?>

            </div>
        </div>
        <script>
            const affdiv = document.querySelector('.listreservation');
            const affbtn = document.getElementById('affbtn');
            if(affbtn)
            {
                affbtn.addEventListener('click', (e)=>{
                    e.preventDefault();
                    affdiv.classList.remove('hidden');
                });
            }
        </script>
</body>
</html>