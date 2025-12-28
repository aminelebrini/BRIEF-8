<?php   
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
    include_once __DIR__ . "/../controllers/books.php";
    include_once __DIR__ . "/../controllers/ReaderMetho.php";


    $User = $_SESSION['user'] ?? null;
    $Books = $_SESSION['books'] ?? [];    

    if (!isset($_SESSION['borrows'])) {
        $_SESSION['borrows'] = [];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>BOOKS</title>
</head>
<body class="bg-[#1B1B1E] text-[#F2F5F3]">
    <?php if($_SESSION['user']['role'] === 'reader'): 
        ?>
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
<div class="books relative flex flex-wrap items-center justify-start gap-6 px-6 py-8 w-full">
    <?php foreach($Books as $book): ?>
    <div class="bg-[#141618] border border-[#17181B] rounded-2xl shadow-lg p-6 flex flex-col gap-4 w-full sm:w-[320px] md:w-[340px]">
        <form method="POST" class="flex flex-col gap-3 h-auto">
            <h2 class="text-lg font-semibold">
                <?= htmlspecialchars($book->get_title()) ?>
            </h2>

            <p class="text-sm text-gray-300">Id : <?= htmlspecialchars($book->get_book_id()) ?></p>
            <p class="text-sm text-gray-300">Auteur : <?= htmlspecialchars($book->get_author()) ?></p>
            <p class="text-sm text-gray-300">Année : <?= htmlspecialchars($book->get_year()) ?></p>

            <p class="text-sm"> Status : <span class="<?= $book->get_status()==='available' ? 'text-green-400' : 'text-red-400' ?>"><?= htmlspecialchars($book->get_status()) ?></span></p>
            <?php if($book->get_status() === "available"): ?>
                <div class="mt-2 flex flex-col gap-2">
                    <label class="text-gray-300 text-sm">Date de début</label>
                    <input type="date" name="startdate" class="text-black border border-gray-300 rounded-lg p-2 w-full bg-white" required>

                    <label class="text-gray-300 text-sm">Date de fin</label>
                    <input
                        type="date"
                        name="enddate"
                        class="text-black border border-gray-300 rounded-lg p-2 w-full bg-white"
                        required>
                </div>
                <button
                    type="submit"
                    name="book"
                    value="<?= $book->get_book_id(); ?>"
                    class="mt-3 px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white font-medium w-full transition">
                    Emprunter
                </button>
                </form>
                <?php else: ?>
                <button
                    type="button"
                    class="mt-3 px-4 py-2 rounded-lg bg-gray-500 text-white font-medium w-full cursor-not-allowed"
                    disabled>
                    Indisponible
                </button>
                <form>
                <button
                    type="submit"
                    name="removebtn"
                    value="<?= $book->get_book_id(); ?>"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded w-full">
                    Remove
                </button>
                </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        const btnsEmprunt = document.querySelectorAll('.emprunt-btn');
        const bookingDiv = document.querySelector('.booking');

        btnsEmprunt.forEach(btn => {
        btn.addEventListener('click', () => {
            bookingDiv.classList.remove('hidden');
        });
    });

    const btnCancel = document.getElementById('cancel');
    if(btnCancel) {
        btnCancel.addEventListener('click', () => {
            bookingDiv.classList.add('hidden');
        });
    }

    </script>
</body>
</html>