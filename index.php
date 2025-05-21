<?php
// You can add PHP code here if needed, for example, handling the login logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./asset/favicon.ico">
  <link rel="stylesheet" href="style.css">
  <title>ReadME - Login</title>
</head>
<body>
  <div class="login-container">
    <img src="./asset/Bangers.png" alt="ReadME Logo" class="logo">
    <h1>ReadME</h1>
    <p class="subtitle">DIGITAL COMIC BOOKSTORE</p>
    
    <form method="POST" action="login.php" class="login-form">
      <input type="text" name="email" placeholder="Email" required>
      <div class="password-container">
        <input class="password" type="password" name="password" placeholder="Password" required>
        <span class="toggle-password">👁️</span>
      </div>
      
      <label class="remember-me">
        <input type="checkbox" name="remember" checked> Remember me
      </label>

      <button type="submit" class="sign-in">Sign In</button>
      <a href="#" class="forgot-password">Forgot Password?</a>
      <button type="button" class="create-account" onclick="window.location.href='register.php'">Create Account</button>
    </form>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector(".toggle-password");
    if (togglePassword) {
        togglePassword.addEventListener("click", () => {
            const passwordInput = document.querySelector(".password");
            if (passwordInput) {
                passwordInput.type = passwordInput.type === "password" ? "text" : "password";
            }
        });
    }
});
  </script>
</body>
</html>
