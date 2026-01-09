<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNNify - Buy. Sell. LionStyle.</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/campus_buy_and_sell/assets/css/style.css">
    <script src="/campus_buy_and_sell/assets/js/script.js" defer></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">  
</head>
<body>


<header class="navbar">
    <div class="nav-container">
        <a href="/campus_buy_and_sell/index.php" class="logo">
            <img src="/campus_buy_and_sell/assets/images/unnify.png" alt="UNNify Logo">
            <span>UNNify</span>
        </a>

        <nav class="nav-links">
            <a href="/campus_buy_and_sell/index.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){ echo 'active'; } ?>">Home</a>
            <a href="/campus_buy_and_sell/listings/market.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'market.php'){ echo 'active'; } ?>">Marketplace</a>
            <a href="/campus_buy_and_sell/faq.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'faq.php'){ echo 'active'; } ?>">FAQs</a>
            <a href="/campus_buy_and_sell/contact.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'contact.php'){ echo 'active'; } ?>">Contact</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="/campus_buy_and_sell/admin/admin_dashboard.php" 
             class="admin-btn <?php if(basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php'){ echo 'active'; } ?>">
            🛡️ Admin
             </a>
        <?php endif; ?>

            <a href="/campus_buy_and_sell/auth/login.php" class="login-btn <?php if(basename($_SERVER['PHP_SELF']) == 'login.php'){ echo 'active'; } ?>">Login</a>
            <a href="/campus_buy_and_sell/auth/register.php" class="register-btn <?php if(basename($_SERVER['PHP_SELF']) == 'register.php'){ echo 'active'; } ?>">Register</a>
        </nav>

        <!-- Hamburger Menu -->
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <nav class="mobile-menu" id="mobileMenu">
        <a href="/campus_buy_and_sell/index.php">Home</a>
        <a href="/campus_buy_and_sell/listings/market.php">Marketplace</a>
        <a href="/campus_buy_and_sell/faq.php">FAQs</a>
        <a href="/campus_buy_and_sell/contact.php">Contact</a>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="/campus_buy_and_sell/admin/admin_dashboard.php" 
             class="admin-btn <?php if(basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php'){ echo 'active'; } ?>">
            🛡️ Admin
             </a>
        <?php endif; ?>      
        <a href="/campus_buy_and_sell/auth/login.php" class="login-btn">Login</a>
        <a href="/campus_buy_and_sell/auth/register.php" class="register-btn">Register</a>
    </nav>
</header>
