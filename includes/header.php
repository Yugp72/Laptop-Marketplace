<?php
echo '
<header>
    <div class="box-img-header">
        <img class="img-logo" src="/laptop-marketplace/images/logo-png.png" alt="Laptop Marketplace Logo">
    </div>
    <nav>
        <a href="../index.php#browse-laptops" class="nav-links">Browse Laptops</a>
        <a href="../index.php#buy-laptops" class="nav-links">Buy Now</a>
        <a href="../index.php#sell-laptops" class="nav-links">Sell Laptops</a>
        <a href="../index.php#support" class="nav-links">Support</a>
    </nav>
    <div class="box-btn-actions" id="auth-buttons">
        <a href="../jwt-login-app/auth/register.php" id="register-link"><button class="btn-action">Sign Up</button></a>
        <a href="../jwt-login-app/auth/login.php" id="login-link"><button class="btn-action">Log In</button></a>
        <a href="../jwt-login-app/auth/logout.php" id="logout-link" style="display:none;"><button class="btn-action">Logout</button></a>
    </div>
</header>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem("token");
    const loginBtn = document.getElementById("login-link");
    const registerBtn = document.getElementById("register-link");
    const logoutBtn = document.getElementById("logout-link");

    if (token) {
      // User is logged in
      if (loginBtn) loginBtn.style.display = "none";
      if (registerBtn) registerBtn.style.display = "none";
      if (logoutBtn) logoutBtn.style.display = "inline-block";
    } else {
      // Not logged in
      if (logoutBtn) logoutBtn.style.display = "none";
    }
  });
</script>
';
?>

