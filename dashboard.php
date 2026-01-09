<?php
session_start();
$success = $_SESSION['flash_success'] ?? null;
$error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
require_once 'includes/db.php';
if (!isset($_SESSION['email'])) {
    header("Location: auth/login.php");
    exit();
}

$email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT username, user_type FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $user ? $user['username'] : 'User';
$user_type = $user ? $user['user_type'] : 'User Type Not Set';
// Count items posted by this user
$stmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE user_email = ?");
$stmt->execute([$email]);
$itemCount = $stmt->fetchColumn();

?>

<?php include('includes/header.php'); ?>

<!-- 🟩 Place messages HERE, just below header -->
<?php if ($success): ?>
  <div class="alert success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="alert error"><?php echo $error; ?></div>
<?php endif; ?>


<div class="dashboard-container">
    <div class="welcome-text">Welcome back, <?php echo htmlspecialchars($username); ?> 👋</div>
    <p class="tagline">Manage your activities, listings and more from one place.</p>

    <div class="profile-box">
       <?php
            // Fetch profile_pic from database
            $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            $profilePic = $user['profile_pic'] ? "assets/images/" . $user['profile_pic'] : "assets/images/unnify.PNG";
            ?>
            <img src="<?php echo $profilePic; ?>" alt="Profile Picture" style="border-radius: 50%; width: 80px; height: 80px;">

        <div>

            <strong><?php echo $username; ?></strong><br>
            <?php echo $email; ?> <span style="color: green; font-size: 0.9em;">(verified)</span>

              <!-- Profile Picture Upload Form -->
             <form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
                <label for="profileUpload" style="cursor: pointer;">
                 <i class="fas fa-camera" title="Change Profile Picture" style="font-size: 22px; color: currentColor;"></i>
                </label>

           <input type="file" id="profileUpload" name="profile_pic" accept="image/*" onchange="this.form.submit()" style="display: none;">
            </form>

        </div>
    </div>

    <div class="dashboard-cards">
        <div class="dash-card">
            <h3>Items Posted</h3>
            <p><?php echo $itemCount; ?></p>
        </div>
        <div class="dash-card">
            <h3>Email Verified</h3>
            <p>✔️</p>
        </div>
        <div class="dash-card">
            <h3>User Type</h3>
            <p><?php echo htmlspecialchars($user_type); ?></p>
        </div>
        <div class="dash-card">
            <h3>Messages</h3>
            <p>Coming Soon</p>
        </div>
    </div>

    <div class="dashboard-actions">
        <a href="/campus_buy_and_sell/listings/post_item.php" class="dash-action">📦 Post Item</a>
        <a href="/campus_buy_and_sell/listings/my_listings.php" class="dash-action">📋 My Listings</a>
        <a href="/campus_buy_and_sell/listings/market.php" class="dash-action">🌐View Marketplace</a>
        <a href="/campus_buy_and_sell/profile/profile.php" class="dash-action">👤 My Profile</a>
        <a href="/campus_buy_and_sell/auth/logout.php" class="dash-action logout">🚪 Logout</a>
    </div>
</div>


<?php include('includes/footer.php'); ?>

<script>
  const alertBox = document.querySelector('.alert');
  if (alertBox) {
    setTimeout(() => {
      alertBox.style.opacity = '0';
      setTimeout(() => alertBox.style.display = 'none', 500);
    }, 3000); // fades out after 3s
  }
</script>

