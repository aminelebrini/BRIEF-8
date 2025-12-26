<?php
    include __DIR__ . "/../controllers/signupcontroller.php";
    include __DIR__ . "/../controllers/logincontrollers.php";
    include_once __DIR__ . "/../controllers/logout.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyLibrary</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#1B1B1E] text-[#F2F5F3] flex items-center justify-center p-6">

  <div class="flex flex-col items-center justify-between w-full">

    <div class="logindis md:w-[30%] bg-[#141618] rounded-2xl p-6 shadow-lg border border-[#17181B]">
      <h1 class="text-2xl font-semibold mb-6 text-[#F2F5F3]">Login — Staff</h1>

      <form method="POST">

        <div class="mb-5">
          <label class="block mb-1 text-sm">Email</label>
          <input type="email" name="email" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <div class="mb-5">
          <label class="block mb-1 text-sm">Password</label>
          <input type="password" name="password" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <input type="hidden" name="role" value="staff">

        <button type="submit" name="signin" class="w-full mt-2 bg-[#6139B4] text-white py-2 rounded-lg">
          Login
        </button>

        <div class="mt-4 flex flex-col gap-1 text-sm">
          <a href="reader_login.php">Login as Reader</a>
          <a id="signup">Signup</a>
          <a href="forgot_password.php">Forgot Password?</a>
        </div>

      </form>
    </div>

    <div class="signupdis hidden bg-[#141618] rounded-2xl p-6 shadow-lg border border-[#17181B]">
      <h1 class="text-2xl font-semibold mb-6 text-[#F2F5F3]">Create Account</h1>

      <form method="POST">
        <div class="mb-5">
          <label class="block mb-1 text-sm">First Name</label>
          <input type="text" name="firstname" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <div class="mb-5">
          <label class="block mb-1 text-sm">Last Name</label>
          <input type="text" name="lastname" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <div class="mb-5">
          <label class="block mb-1 text-sm">Email</label>
          <input type="email" name="email" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <div class="mb-6">
          <label class="block mb-1 text-sm">Password</label>
          <input type="password" name="password" class="w-full rounded-lg px-3 py-2 bg-[#1B1B1E] border border-[#17181B]" required />
        </div>

        <button type="submit" name="signup" class="w-full bg-[#6139B4] text-white py-2 rounded-lg">
          Sign up
        </button>
      </form>
    </div>

  </div>

  <script>

    const Signupbtn = document.getElementById("signup");
      const signup = document.querySelector(".signupdis");
      const login = document.querySelector(".logindis");

      if (Signupbtn) {
        Signupbtn.addEventListener("click", () => {
        login.classList.add("hidden");
        signup.classList.remove("hidden");
      });
  }
  </script>

</body>
</html>
