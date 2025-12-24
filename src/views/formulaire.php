<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MyLibrary</title>
</head>
<body>
<div class="logincontainer">
    <h1>Login As a STAFF</h1>

    <form method="POST" action="login_process.php">

        <div class="input">
            <label for="email">Username</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <input type="hidden" name="role" value="staff">

        <div class="input">
            <button type="submit">Login</button>
        </div>

        <div class="input">
            <a href="reader_login.php">Login As a READER</a>
            <a href="signup.php">Signup</a>
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
</div>

<div class="logincontainer">
    <h1>Login As a READER</h1>

    <form method="POST" action="login_process.php">

        <div class="input">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <input type="hidden" name="role" value="reader">

        <div class="input">
            <button type="submit">Login</button>
        </div>

        <div class="input">
            <a href="staff_login.php">Login As a STAFF</a>
            <a href="signup.php">Signup</a>
        </div>
    </form>
</div>

<div class="logincontainer">
    <h1>Create Account</h1>

    <form method="POST" action="signup_process.php">

        <div class="input">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="input">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input">
            <a href="reader_login.php">Login As a READER</a>
            <a href="staff_login.php">Login As a STAFF</a>
        </div>

        <button type="submit">Sign up</button>
    </form>
</div>


</body>
</html>