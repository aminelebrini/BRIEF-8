const Signupbtn = document.getElementById("signup");
      const signup = document.querySelector(".signupdis");
      const login = document.querySelector(".logindis");

      if (Signupbtn) {
        Signupbtn.addEventListener("click", () => {
        login.classList.add("hidden");
        signup.classList.remove("hidden");
      });
  }