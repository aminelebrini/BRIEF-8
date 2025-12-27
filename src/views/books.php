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
    <div class="books relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 py-8">
    <?php foreach($Books as $book): ?>
        <div class="bg-[#141618] border border-[#17181B] rounded-2xl shadow-lg p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
            <div class="bg-[#141618] ...">
                
                <h2><?= htmlspecialchars($book->get_title()) ?></h2>
                <p>Id : <?= htmlspecialchars($book->get_book_id()) ?></p>
                <p>Auteur : <?= htmlspecialchars($book->get_author()) ?></p>
                <p>Année : <?= htmlspecialchars($book->get_year()) ?></p>
                <p>Status : <?= htmlspecialchars($book->get_status()) ?></p>
            </div>
            <?php if($book->get_status() === "available"): ?>
                <button type="submit" class="emprunt-btn px-4 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white font-medium w-[200px] transition">Emprunter</button>
            <?php elseif($book->get_status() === "unavailable"): ?>
                <button type="button" class="px-4 py-2 rounded-lg bg-gray-500 text-white font-medium w-[200px] cursor-not-allowed" disabled>Indisponible</button>
                <form method="POST" class="mt-2">
                    <button type="submit" name="removebtn" value="<?= $book->get_book_id(); ?>" class="px-4 py-2 bg-red-600 text-white rounded w-full">
                        Remove
                    </button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <?php foreach($Books as $book): ?>
    <div class="booking hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-11/12 max-w-md md:max-w-lg flex flex-col gap-4">
                <div class="cancel">
                    <button type="button" id="cancel" class="text-white bg-red-500 hover:bg-red-600 rounded-full w-8 h-8 flex items-center justify-center transition shadow-md"><i class="fas fa-multiply"></i></button>
                </div>
                <form method="POST" class="flex flex-col gap-4 w-full">

                    <label class="text-gray-700 font-medium">id du reader</label>
                    <input type="text" name="readerid" value="<?= htmlspecialchars($_SESSION['user']['id']); ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">id du livre</label>
                    <input type="text" name="bookid" value="<?= $book->get_title() ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">Titre du livre</label>
                    <input type="text" name="bookname" value="<?= htmlspecialchars($book->get_title()) ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">Auteur</label>
                    <input type="text" name="bookauthor" value="<?= htmlspecialchars($book->get_author()) ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">Année</label>
                    <input type="text" name="bookyear" value="<?= htmlspecialchars($book->get_year()) ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">Statut</label>
                    <input type="text" name="bookstatus" value="<?= htmlspecialchars($book->get_status()) ?>" class="text-black border rounded-lg p-2 w-full" readonly>

                    <label class="text-gray-700 font-medium">Date de début</label>
                    <input type="date" name="startdate" class="text-black border rounded-lg p-2 w-full" required>

                    <label class="text-gray-700 font-medium">Date de fin</label>
                    <input type="date" name="enddate" class="text-black border rounded-lg p-2 w-full" required>

                    <button type="submit" name="book" class="px-6 py-2 rounded-lg bg-[#6139B4] hover:bg-[#4f2d91] text-white font-semibold text-sm transition transform hover:scale-105 shadow-md">BOOK NOW</button>
                </form>
            </div>
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