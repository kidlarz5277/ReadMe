<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" type="image/x-icon" href="./asset/favicon.ico">
  <link rel="stylesheet" href="register.css"/>
  
  <title>Register - ReadME</title>
</head>
<body>

  <div class="register-container">
    <img src="./asset/register logo.png" alt="ReadME Logo" class="logo" />
    <h1>ReadME</h1>
    <p class="subtitle">DIGITAL COMIC BOOKSTORE</p>
    <form class="register-form" method="POST" action="registeracc.php">
      <div class="name-row">
        <input type="text" name="first_name" placeholder="First Name" required />
        <input type="text" name="last_name" placeholder="Last Name" required />
      </div>

      <label class="birthdate-label">BirthDate</label>
      <div class="birthdate-row">
        <input type="date" name="birth" id="birth" required />
      </div>

      <input type="email" name="email" placeholder="Email" required />


      <div class="password-container">
        <input type="password" name="password" placeholder="Password" required />
        <span class="toggle-password">👁️</span>
      </div>
      <div class="password-container">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
        <span class="toggle-password">👁️</span>
      </div>

      <button type="submit" class="signup-btn">Sign up</button>
      <a href="index.php" class="login-link">Already have an account</a>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
