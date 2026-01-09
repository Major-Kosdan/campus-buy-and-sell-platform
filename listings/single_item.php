<?php
session_start();
require_once '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: market.php"); // Fallback
    exit();
}

$item_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT items.*, users.username, users.user_type, users.profile_pic FROM items JOIN users ON items.user_email = users.email WHERE items.id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$item) {
    echo "<p>❌ Item not found.</p>";
    exit();
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
  <div class="single-item">
    <div class="item-left">
      <img src="../assets/images/upload/<?php echo htmlspecialchars($item['image']); ?>" alt="Item Image">
    </div>

    <div class="item-right">
      <div style="position: relative; display: flex; align-items: center; gap: 10px;">
  <a href="../assets/images/<?php echo htmlspecialchars($item['profile_pic']); ?>" target="_blank" style="position: relative; display: inline-block;">
         <img src="../assets/images/<?php echo htmlspecialchars($item['profile_pic']); ?>" 
         alt="Seller Profile Picture" 
         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
        <span title="View full image" style="position: absolute; bottom: -5px; right: -5px; background: white; border-radius: 50%; padding: 2px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#555" viewBox="0 0 16 16">
        <path d="M16 8s-3.5 5.5-8 5.5S0 8 0 8s3.5-5.5 8-5.5S16 8 16 8z"/>
        <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>
      </span>
  </a>
  <div style="line-height: 1.2;">
    <strong>👤 Seller:</strong><br>
    <?php 
        echo htmlspecialchars($item['username']); 
        if (isset($item['user_type'])) {
            echo " (" . htmlspecialchars($item['user_type']) . ")";
        }
    ?>
  </div>
</div>


      <h2><?php echo htmlspecialchars($item['title']); ?></h2>
      <p class="price-tag">₦<?php echo number_format($item['price']); ?></p>
      <p><strong>Category:</strong> <?php echo htmlspecialchars($item['category']); ?></p>
      <p><strong>Condition:</strong> <?php echo htmlspecialchars($item['condition']); ?></p>
      <p><strong>Location:</strong> 📍 <?php echo htmlspecialchars($item['location']); ?></p>
      <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
      <p><strong>Contact Seller:</strong></p>
      <?php
        $cleanContact = preg_replace('/^0/', '234', preg_replace('/\D/', '', $item['contact']));
        $whatsappLink = "https://wa.me/{$cleanContact}";
      ?>
      <a href="<?php echo $whatsappLink; ?>" class="contact-seller" target="_blank">📞 WhatsApp / Call</a>
      <br><br>
      <a href="javascript:history.back()" class="go-back">⬅️ Back</a>
    </div>
  </div>
</div>

<?php include('../includes/footer.php'); ?>
