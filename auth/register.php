<?php include('../includes/header.php'); ?>

<section class="auth-section">
    <div class="auth-container animate-slide">
        <h2>Create Your UNNify Account</h2>
        <p>Only verified <strong>UNN</strong> emails will be accepted</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-box" id="errorBox"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="process_register.php" method="POST" class="auth-form">
            <input type="text" name="username" placeholder="Enter your FullName" required>

            <input type="email" name="email" placeholder="Enter your UNN email" required>

                  <select name="user_type" required class="auth-select">
            <option value="">Select User Type</option>
            <option value="student">Student</option>
            <option value="staff">Staff</option>
            <option value="lecturer">Lecturer</option>
            <option value="administrator">Administrator</option>
               </select>

            <input type="password" name="password" placeholder="Enter password" required>
            <input type="password" name="confirm_password" placeholder="Confirm password" required>

            <button type="submit" class="auth-btn">Register</button>
        </form>

        <p>Already registered and verified? <a href="login.php">Login here</a></p>
    </div>
</section>

<?php include('../includes/footer.php'); ?>

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
