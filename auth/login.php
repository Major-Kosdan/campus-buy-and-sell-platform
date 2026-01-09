<?php
session_start();
$success = $_SESSION['flash_success'] ?? null;
$error = $_SESSION['flash_error'] ?? null;
$logoutMsg = $_SESSION['flash_logout'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error'], $_SESSION['flash_logout']);

?>
<?php include('../includes/header.php'); ?>

<section class="auth-section">
    <div class="auth-container animate-slide">
        <h2>Welcome to UNNify👋</h2>
        <p>Login to access the marketplace</p>

         <?php if (isset($_GET['error'])): ?>
            <div class="error-box" id="errorBox"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

            <?php if ($logoutMsg): ?>
        <div class="alert success"><?php echo $logoutMsg; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="alert success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
        <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>


        <form action="process_login.php" method="POST" class="auth-form">
            <input type="email" name="email" placeholder="UNN Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="auth-btn">Login</button>
        </form>

        <p>Don’t have an account? <a href="register.php">Register</a></p>
    </div>
</section>

<?php include('../includes/footer.php'); ?>

<script>
  const alertBox = document.querySelector('.alert');
  if (alertBox) {
    setTimeout(() => {
      alertBox.style.opacity = '0';
      setTimeout(() => alertBox.style.display = 'none', 500);
    }, 3000); // fades out after 3s
  }
</script>

<script>
  const errorBox = document.getElementById('errorBox');
  if (errorBox) {
    setTimeout(() => {
      errorBox.style.animation = 'fadeOut 0.5s ease-out forwards';
      setTimeout(() => {
        errorBox.style.display = 'none'; // This hides it after animation
      }, 500);
    }, 4000);
  }
</script>
<style>
@keyframes fadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    height: 0;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }
}
</style> 


