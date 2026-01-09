<?php
session_start();
require_once '../includes/db.php';
if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}
$email = $_SESSION['email'];

// Flash messages
$success = $_SESSION['flash_success'] ?? null;
$error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

$stmt = $pdo->prepare("SELECT * FROM items WHERE user_email = ? ORDER BY created_at DESC");
$stmt->execute([$email]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
  <h2>📋 My Listings</h2>

  <?php if ($success): ?>
    <div class="alert success"><?php echo $success; ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert error"><?php echo $error; ?></div>
  <?php endif; ?>

  <?php if (count($items) === 0): ?>
    <p>You haven't posted any items yet. <a href="/campus_buy_and_sell/listings/post_item.php">Post one now</a>.</p>
  <?php else: ?>
    <div class="items-grid">
      <?php foreach ($items as $item): ?>
        <div class="item-card">
          <img src="../assets/images/upload/<?php echo htmlspecialchars($item['image']); ?>" alt="Item image">
          <h3><?php echo htmlspecialchars($item['title']); ?></h3>
          <p><strong>₦<?php echo number_format($item['price']); ?></strong></p>
          <p><?php echo htmlspecialchars($item['location']); ?></p>
          <p><?php echo htmlspecialchars($item['category']); ?> | <?php echo htmlspecialchars($item['condition']); ?></p>
          <p><?php echo substr(htmlspecialchars($item['description']), 0, 80); ?>...</p>

          <div class="item-actions">
            <a href="edit_item.php?id=<?php echo $item['id']; ?>" class="btn edit">✏️ Edit</a>
            <a href="delete_item.php?id=<?php echo $item['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this item?');">🗑️ Delete</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <div style="text-align: center; margin-top: 30px;">
  <a href="../listings/market.php" class="back-dashboard-btn">🌐View Marketplace</a>
</div>
</div>

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

