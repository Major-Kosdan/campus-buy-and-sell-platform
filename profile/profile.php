<?php
session_start();
require_once '../includes/db.php';
$success = $_SESSION['flash_success'] ?? null;
$error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}
$email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $user ? $user['username'] : 'User';
?>

<?php include('../includes/header.php'); ?>
<?php if ($success): ?>
  <div class="alert success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="alert error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="container container--profile">
  <h2 class="page-title">👤 Account Settings</h2>
  <p class="page-subtitle">Manage your username and password</p>

  <!-- Update Username -->
  <div class="settings-card">
    <h3>✏️ Update Username</h3>
    <form method="POST" action="update_username.php">
      <label>Current Email:</label>
      <input type="email" value="<?php echo htmlspecialchars($email); ?>" disabled>

      <label for="username">New Username:</label>
      <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>

      <button type="submit">✅ Update Username</button>
    </form>
  </div>

  <!-- Change Password -->
  <div class="settings-card">
    <h3>🔐 Change Password</h3>
    <form method="POST" action="change_password.php">
      <label for="current_password">Current Password:</label>
      <input type="password" name="current_password" required>

      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" required>

      <label for="confirm_password">Confirm New Password:</label>
      <input type="password" name="confirm_password" required>

      <button type="submit">🔁 Change Password</button>
    </form>
  </div>
  <div style="text-align: center; margin-top: 30px;">
  <a href="../dashboard.php" class="back-dashboard-btn">🔙 Go Back to Dashboard</a>
</div>
</div>

<?php include('../includes/footer.php'); ?>

<script>
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
      el.style.opacity = '0';
      el.style.transition = 'opacity 0.5s ease';
    });
  }, 4000);
</script>

