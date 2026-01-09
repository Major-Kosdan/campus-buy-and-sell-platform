<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in or not admin
if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

$adminEmail = $_SESSION['email'];

// TODO: Add role check once you store roles (we’ll use a workaround now)
$email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $user ? $user['username'] : 'Admin';

// Count stats
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalItems = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
$verifiedUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE is_verified = 1")->fetchColumn();
?>

<?php include('../includes/header.php'); ?>

<div class="dashboard-container">
    <div class="welcome-text">Welcome back, Admin 👑</div>
    <p class="tagline">Monitor marketplace activity and manage users/listings.</p>

<div class="profile-box">
       <?php
            // Fetch profile_pic from database
            $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            $profilePic = $user['profile_pic'] ? "../assets/images/" . $user['profile_pic'] : "../assets/images/default_avatar.jpg";
            ?>
            <img src="<?php echo $profilePic; ?>" alt="Profile Picture" style="border-radius: 50%; width: 80px; height: 80px;">

        <div>

            <strong><?php echo $username; ?> (Admin)</strong><br>
            <?php echo $email; ?> 

              <!-- Profile Picture Upload Form -->
             <form action="../upload_profile_pic.php" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
                <label for="profileUpload" style="cursor: pointer;">
                 <i class="fas fa-camera" title="Change Profile Picture" style="font-size: 22px; color: currentColor;"></i>
                </label>

           <input type="file" id="profileUpload" name="profile_pic" accept="image/*" onchange="this.form.submit()" style="display: none;">
            </form>

        </div>
    </div>

    <div class="dashboard-cards">
        <div class="dash-card"><h3>Total Users</h3><p><?php echo $totalUsers; ?></p></div>
        <div class="dash-card"><h3>Listings</h3><p><?php echo $totalItems; ?></p></div>
        <div class="dash-card"><h3>Verified Users</h3><p><?php echo $verifiedUsers; ?></p></div>
        <div class="dash-card"><h3>Flagged Posts</h3><p>Coming Soon</p></div>
    </div>

    <div class="dashboard-actions">
        <a href="manage_users.php" class="dash-action">🧑‍💻 Manage Users</a>
        <a href="manage_items.php" class="dash-action">🗂️ Manage Listings</a>
        <a href="../listings/market.php" class="dash-action">🌐 View Marketplace</a>
        <a href="../dashboard.php" class="dash-action">🔙 User Dashboard</a>
        <a href="../auth/logout.php" class="dash-action logout">🚪 Logout</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
