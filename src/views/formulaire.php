<?php
    include_once __DIR__ . "/../controllers/Auth.php";
    include_once __DIR__ . "/../controllers/AdminMeth.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion — MyLibrary</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass { background: rgba(20, 22, 24, 0.8); backdrop-filter: blur(12px); }
    .gradient-text { background: linear-gradient(135deg, #a78bfa, #6139B4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    input:focus { outline: none; border-color: #6139B4; box-shadow: 0 0 0 2px rgba(97, 57, 180, 0.2); }
  </style>
</head>

<body class="min-h-screen bg-[#0f1113] text-[#F2F5F3] flex items-center justify-center p-6 relative overflow-hidden">

  <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#6139B4]/10 blur-[120px] rounded-full"></div>
  <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-[#a78bfa]/10 blur-[120px] rounded-full"></div>

  <div class="w-full max-w-md z-10">
    
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold tracking-tight">My<span class="gradient-text">Library</span></h1>
        <p class="text-gray-500 text-sm mt-2">Accédez à votre univers littéraire</p>
    </div>

    <div class="logindis glass rounded-[2rem] p-8 shadow-2xl border border-white/5 transition-all duration-500">
      <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-circle-user text-[#a78bfa]"></i> Connexion
      </h2>

      <form method="POST" class="space-y-5">
        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-gray-400 italic">Email</label>
          <div class="relative">
            <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-600"></i>
            <input type="email" name="email" class="w-full rounded-xl pl-10 pr-4 py-3 bg-white/5 border border-white/10 transition" placeholder="votre@email.com" required />
          </div>
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold uppercase tracking-widest text-gray-400 italic">Mot de passe</label>
          <div class="relative">
            <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-600"></i>
            <input type="password" name="password" class="w-full rounded-xl pl-10 pr-4 py-3 bg-white/5 border border-white/10 transition" placeholder="••••••••" required />
          </div>
        </div>

        <input type="hidden" name="role" value="staff">

        <button type="submit" name="signin" class="w-full bg-[#6139B4] hover:bg-[#4f2d91] text-white py-4 rounded-xl font-bold shadow-lg shadow-[#6139B4]/20 transition-all transform active:scale-95">
          Se connecter
        </button>

        <div class="mt-6 flex flex-col gap-3 text-center">
          <a id="signup" class="text-sm text-gray-400 hover:text-[#a78bfa] cursor-pointer transition italic underline decoration-[#6139B4]">
            Pas encore de compte ? Créer un compte
          </a>
          <a href="forgot_password.php" class="text-xs text-gray-500 hover:text-white transition">Mot de passe oublié ?</a>
        </div>
      </form>
    </div>

    <div class="signupdis hidden glass rounded-[2rem] p-8 shadow-2xl border border-white/5 transition-all duration-500">
      <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-user-plus text-[#a78bfa]"></i> Créer un compte
      </h2>

      <form method="POST" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block mb-2 text-xs font-bold text-gray-400 italic">Prénom</label>
              <input type="text" name="firstname" class="w-full rounded-xl px-4 py-3 bg-white/5 border border-white/10 transition" required />
            </div>
            <div>
              <label class="block mb-2 text-xs font-bold text-gray-400 italic">Nom</label>
              <input type="text" name="lastname" class="w-full rounded-xl px-4 py-3 bg-white/5 border border-white/10 transition" required />
            </div>
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold text-gray-400 italic uppercase tracking-widest">Email</label>
          <input type="email" name="email" class="w-full rounded-xl px-4 py-3 bg-white/5 border border-white/10 transition" placeholder="votre@email.com" required />
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold text-gray-400 italic uppercase tracking-widest">URL de l'image (Avatar)</label>
          <input type="url" name="image_url" class="w-full rounded-xl px-4 py-3 bg-white/5 border border-white/10 transition" placeholder="https://..." required />
        </div>

        <div>
          <label class="block mb-2 text-xs font-bold text-gray-400 italic uppercase tracking-widest">Mot de passe</label>
          <input type="password" name="password" class="w-full rounded-xl px-4 py-3 bg-white/5 border border-white/10 transition" required />
        </div>

        <button type="submit" name="signup" class="w-full bg-[#6139B4] hover:bg-[#4f2d91] text-white py-4 rounded-xl font-bold transition-all shadow-lg shadow-[#6139B4]/20">
          S'inscrire
        </button>

        <p class="text-center text-sm text-gray-400 mt-4">
            Déjà membre ? <span id="backToLogin" class="text-[#a78bfa] cursor-pointer hover:underline font-bold">Connexion</span>
        </p>
      </form>
    </div>

  </div>

  <script>
    const Signupbtn = document.getElementById("signup");
    const Backbtn = document.getElementById("backToLogin");
    const signup = document.querySelector(".signupdis");
    const login = document.querySelector(".logindis");

    if (Signupbtn) {
      Signupbtn.addEventListener("click", () => {
        login.classList.add("hidden");
        signup.classList.remove("hidden");
      });
    }

    if (Backbtn) {
      Backbtn.addEventListener("click", () => {
        signup.classList.add("hidden");
        login.classList.remove("hidden");
      });
    }
  </script>

</body>
</html>