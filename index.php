<!-- Loader -->
<div id="loader">
    <img src="assets/images/unnify.png" alt="Loading..." />
</div>

<?php include('includes/header.php'); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="animate-slide">Welcome to <span>UNNify</span></h1>
       <p class="animate-fade">
        Your all-in-one campus marketplace designed exclusively for UNN students — discover amazing deals, sell effortlessly, and connect with trusted buyers and sellers across the Lion community. 🦁
        </p>

        <form action="/campus_buy_and_sell/listings/market.php" method="GET" class="search-bar animate-up">
            <input type="text" name="search" placeholder="Search for items...">
            <button type="submit">Search</button>
        </form>

        <a href="auth/register.php" class="cta-btn animate-fade">Join Now</a>
    </div>
</section>

<?php
require_once 'includes/db.php'; // adjust path
$previewStmt = $pdo->query("SELECT * FROM items ORDER BY created_at DESC LIMIT 8");
$previewItems = $previewStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="homepage-market-preview">
  <h2 class="section-title">🔥 Latest in the Marketplace</h2>
  <p class="section-subtitle">Preview a few items. Log in to explore more and contact sellers.</p>

  <div class="items-grid">
    <?php foreach ($previewItems as $item): ?>
      <div class="market-card preview">
        <img src="assets/images/upload/<?php echo htmlspecialchars($item['image']); ?>" alt="Item image">
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
        <p class="price">₦<?php echo number_format($item['price']); ?></p>
        <p class="meta"><?php echo htmlspecialchars($item['category']); ?> | 📍 <?php echo htmlspecialchars($item['location']); ?></p>
        <p class="desc"><?php echo substr(htmlspecialchars($item['description']), 0, 60); ?>...</p>

      </div>
    <?php endforeach; ?>
  </div>

  <div class="cta-wrapper" style="text-align: center; margin-top: 25px;">
    <a href="auth/register.php" class="btn explore-btn">Create Account to Access Marketplace</a>
  </div>
</section>


<?php include('includes/footer.php'); ?>

