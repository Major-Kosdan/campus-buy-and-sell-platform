<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['flash_error'] = "Please log in to access the Marketplace.";
    header("Location: ../auth/login.php");
    exit();
}

require_once '../includes/db.php';

// Search + Filter Handling
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$location = $_GET['location'] ?? '';

$sql = "SELECT * FROM items WHERE 1";
$params = [];

if (!empty($search)) {
  $sql .= " AND title LIKE ?";
  $params[] = "%$search%";
}
if (!empty($category)) {
  $sql .= " AND category = ?";
  $params[] = $category;
}
if (!empty($location)) {
  $sql .= " AND location = ?";
  $params[] = $location;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../includes/header.php'); ?>

<div class="container">
  <h2 class="page-title">🛍️ General Marketplace</h2>
  <p class="page-subtitle">Browse items listed by other students across UNN</p>

  <!-- ⚠️ WARNING SECTION -->
  <div class="market-warning blink">
    ⚠️ <strong>Safety Tip:</strong> Please ensure you meet the seller in a safe, well-known campus location (e.g., Tetfund, Mbanefo, Hilltop, Odim, Okpara, Green House, etc.) before making any payments.<br><br>
    <span class="do-not-pay">🚫 <strong>NEVER pay in advance.</strong> Always inspect the item before payment!</span>
  </div>

  <!-- 🔍 SEARCH + FILTER BAR -->
  <div class="search-filter-bar">
    <form method="GET" action="">
      <input type="text" name="search" placeholder="🔍 Search items..." value="<?php echo htmlspecialchars($search); ?>">

     <select name="category">
  <option value="">All Categories</option>
  <option value="Electronics" <?= $category === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
  <option value="Fashion" <?= $category === 'Fashion' ? 'selected' : '' ?>>Fashion</option>
  <option value="Books" <?= $category === 'Books' ? 'selected' : '' ?>>Books</option>
  <option value="Food" <?= $category === 'Food' ? 'selected' : '' ?>>Food</option>
  <option value="Beauty" <?= $category === 'Beauty' ? 'selected' : '' ?>>Beauty</option>
  <option value="Home" <?= $category === 'Home' ? 'selected' : '' ?>>Home</option>
  <option value="Services" <?= $category === 'Services' ? 'selected' : '' ?>>Services</option>
  <option value="Rental" <?= $category === 'Rental' ? 'selected' : '' ?>>Rental</option>
  <option value="Crafts" <?= $category === 'Crafts' ? 'selected' : '' ?>>Crafts</option>
  <option value="Gadgets" <?= $category === 'Gadgets' ? 'selected' : '' ?>>Gadgets</option>
  <option value="Health" <?= $category === 'Health' ? 'selected' : '' ?>>Health</option>
  <option value="Events" <?= $category === 'Events' ? 'selected' : '' ?>>Events</option>
  <option value="Transport" <?= $category === 'Transport' ? 'selected' : '' ?>>Transport</option>
  <option value="Repairs" <?= $category === 'Repairs' ? 'selected' : '' ?>>Repairs</option>
  <option value="Deals" <?= $category === 'Deals' ? 'selected' : '' ?>>Deals</option>
  <option value="Stationery" <?= $category === 'Stationery' ? 'selected' : '' ?>>Stationery</option>
  <option value="Digital" <?= $category === 'Digital' ? 'selected' : '' ?>>Digital</option>
  <option value="Others" <?= $category === 'Others' ? 'selected' : '' ?>>Others</option>
</select>


      <select name="location">
  <option value="">All Locations</option>

  <optgroup label="On Campus">
    <option <?= $location === "Aja Nwachukwu" ? 'selected' : '' ?>>Aja Nwachukwu</option>
    <option <?= $location === "Akintola" ? 'selected' : '' ?>>Akintola</option>
    <option <?= $location === "Akpabio" ? 'selected' : '' ?>>Akpabio</option>
    <option <?= $location === "Alvan Ikoku" ? 'selected' : '' ?>>Alvan Ikoku</option>
    <option <?= $location === "Awolowo" ? 'selected' : '' ?>>Awolowo</option>
    <option <?= $location === "Balewa" ? 'selected' : '' ?>>Balewa</option>
    <option <?= $location === "Bello" ? 'selected' : '' ?>>Bello</option>
    <option <?= $location === "Eni-Njoku" ? 'selected' : '' ?>>Eni-Njoku</option>
    <option <?= $location === "Eyo Ita" ? 'selected' : '' ?>>Eyo Ita</option>
    <option <?= $location === "Isa Kaita" ? 'selected' : '' ?>>Isa Kaita</option>
    <option <?= $location === "Kwame Nkrumah" ? 'selected' : '' ?>>Kwame Nkrumah</option>
    <option <?= $location === "Mary Slessor" ? 'selected' : '' ?>>Mary Slessor</option>
    <option <?= $location === "Mbanefo" ? 'selected' : '' ?>>Mbanefo</option>
    <option <?= $location === "Okeke" ? 'selected' : '' ?>>Okeke</option>
    <option <?= $location === "Okpara" ? 'selected' : '' ?>>Okpara</option>
    <option <?= $location === "Presidential" ? 'selected' : '' ?>>Presidential</option>
    <option <?= $location === "Tetfund" ? 'selected' : '' ?>>Tetfund</option>
  </optgroup>

  <optgroup label="Off Campus">
    <option <?= $location === "Behind Flat" ? 'selected' : '' ?>>Behind Flat</option>
    <option <?= $location === "Green House" ? 'selected' : '' ?>>Green House</option>
    <option <?= $location === "Hilltop" ? 'selected' : '' ?>>Hilltop</option>
    <option <?= $location === "Odenigwe" ? 'selected' : '' ?>>Odenigwe</option>
    <option <?= $location === "Odim" ? 'selected' : '' ?>>Odim</option>
    <option <?= $location === "Presidential Road" ? 'selected' : '' ?>>Presidential Road</option>
  </optgroup>
</select>


      <button type="submit">🔍 Filter</button>
    </form>
  </div>

  <!-- 🧾 ITEM LISTINGS -->
  <?php if (count($items) === 0): ?>
    <p>No items match your search/filter.</p>
  <?php else: ?>
    <div class="items-grid">
      <?php foreach ($items as $item): ?>
        <div class="market-card">
    <a href="single_item.php?id=<?php echo $item['id']; ?>" class="card-link">
    <img src="../assets/images/upload/<?php echo htmlspecialchars($item['image']); ?>" alt="Item image">
    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
    <p class="price">₦<?php echo number_format($item['price']); ?></p>
    <p class="meta"><?php echo htmlspecialchars($item['category']); ?> | <?php echo htmlspecialchars($item['condition']); ?> | 📍 <?php echo htmlspecialchars($item['location']); ?></p>
    <p class="desc"><?php echo substr(htmlspecialchars($item['description']), 0, 90); ?>...</p>
    </a>

     <a href="https://wa.me/<?php echo preg_replace('/^0/', '234', preg_replace('/\D/', '', $item['contact'])); ?>" target="_blank" class="contact-btn">📞 Contact Seller</a>
    </div>

      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <div style="text-align: center; margin-top: 30px;">
  <a href="../dashboard.php" class="back-dashboard-btn">🔙 Go Back to Dashboard</a>
</div>
</div>

<?php include('../includes/footer.php'); ?>
