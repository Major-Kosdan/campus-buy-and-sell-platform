<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

$email = $_SESSION['email'];
$item_id = $_GET['id'] ?? null;

if (!$item_id) {
    $_SESSION['flash_error'] = "Item not specified.";
    header("Location: my_listings.php");
    exit();
}

// Fetch item from DB
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ? AND user_email = ?");
$stmt->execute([$item_id, $email]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    $_SESSION['flash_error'] = "Item not found or unauthorized.";
    header("Location: my_listings.php");
    exit();
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
  <h2>✏️ Edit Item</h2>

  <form action="handle_edit_item.php" method="POST" enctype="multipart/form-data" class="post-form">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>

   <label>Category:</label>
<select name="category" required>
  <option value="Electronics" <?= $item['category'] === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
  <option value="Fashion" <?= $item['category'] === 'Fashion' ? 'selected' : '' ?>>Fashion</option>
  <option value="Books" <?= $item['category'] === 'Books' ? 'selected' : '' ?>>Books</option>
  <option value="Food" <?= $item['category'] === 'Food' ? 'selected' : '' ?>>Food</option>
  <option value="Beauty" <?= $item['category'] === 'Beauty' ? 'selected' : '' ?>>Beauty</option>
  <option value="Home" <?= $item['category'] === 'Home' ? 'selected' : '' ?>>Home</option>
  <option value="Services" <?= $item['category'] === 'Services' ? 'selected' : '' ?>>Services</option>
  <option value="Rental" <?= $item['category'] === 'Rental' ? 'selected' : '' ?>>Rental</option>
  <option value="Crafts" <?= $item['category'] === 'Crafts' ? 'selected' : '' ?>>Crafts</option>
  <option value="Gadgets" <?= $item['category'] === 'Gadgets' ? 'selected' : '' ?>>Gadgets</option>
  <option value="Health" <?= $item['category'] === 'Health' ? 'selected' : '' ?>>Health</option>
  <option value="Events" <?= $item['category'] === 'Events' ? 'selected' : '' ?>>Events</option>
  <option value="Transport" <?= $item['category'] === 'Transport' ? 'selected' : '' ?>>Transport</option>
  <option value="Repairs" <?= $item['category'] === 'Repairs' ? 'selected' : '' ?>>Repairs</option>
  <option value="Deals" <?= $item['category'] === 'Deals' ? 'selected' : '' ?>>Deals</option>
  <option value="Stationery" <?= $item['category'] === 'Stationery' ? 'selected' : '' ?>>Stationery</option>
  <option value="Digital" <?= $item['category'] === 'Digital' ? 'selected' : '' ?>>Digital</option>
  <option value="Others" <?= $item['category'] === 'Others' ? 'selected' : '' ?>>Others</option>
</select>


    <label>Location:</label>
<select name="location" required>
  <optgroup label="On Campus">
    <option value="Aja Nwachukwu" <?= $item['location'] === 'Aja Nwachukwu' ? 'selected' : '' ?>>Aja Nwachukwu</option>
    <option value="Akintola" <?= $item['location'] === 'Akintola' ? 'selected' : '' ?>>Akintola</option>
    <option value="Akpabio" <?= $item['location'] === 'Akpabio' ? 'selected' : '' ?>>Akpabio</option>
    <option value="Alvan Ikoku" <?= $item['location'] === 'Alvan Ikoku' ? 'selected' : '' ?>>Alvan Ikoku</option>
    <option value="Awolowo" <?= $item['location'] === 'Awolowo' ? 'selected' : '' ?>>Awolowo</option>
    <option value="Balewa" <?= $item['location'] === 'Balewa' ? 'selected' : '' ?>>Balewa</option>
    <option value="Bello" <?= $item['location'] === 'Bello' ? 'selected' : '' ?>>Bello</option>
    <option value="Eni-Njoku" <?= $item['location'] === 'Eni-Njoku' ? 'selected' : '' ?>>Eni-Njoku</option>
    <option value="Eyo Ita" <?= $item['location'] === 'Eyo Ita' ? 'selected' : '' ?>>Eyo Ita</option>
    <option value="Isa Kaita" <?= $item['location'] === 'Isa Kaita' ? 'selected' : '' ?>>Isa Kaita</option>
    <option value="Kwame Nkrumah" <?= $item['location'] === 'Kwame Nkrumah' ? 'selected' : '' ?>>Kwame Nkrumah</option>
    <option value="Mary Slessor" <?= $item['location'] === 'Mary Slessor' ? 'selected' : '' ?>>Mary Slessor</option>
    <option value="Mbanefo" <?= $item['location'] === 'Mbanefo' ? 'selected' : '' ?>>Mbanefo</option>
    <option value="Okeke" <?= $item['location'] === 'Okeke' ? 'selected' : '' ?>>Okeke</option>
    <option value="Okpara" <?= $item['location'] === 'Okpara' ? 'selected' : '' ?>>Okpara</option>
    <option value="Presidential" <?= $item['location'] === 'Presidential' ? 'selected' : '' ?>>Presidential</option>
    <option value="Tetfund" <?= $item['location'] === 'Tetfund' ? 'selected' : '' ?>>Tetfund</option>
  </optgroup>

  <optgroup label="Off Campus">
    <option value="Behind Flat" <?= $item['location'] === 'Behind Flat' ? 'selected' : '' ?>>Behind Flat</option>
    <option value="Green House" <?= $item['location'] === 'Green House' ? 'selected' : '' ?>>Green House</option>
    <option value="Hilltop" <?= $item['location'] === 'Hilltop' ? 'selected' : '' ?>>Hilltop</option>
    <option value="Odenigwe" <?= $item['location'] === 'Odenigwe' ? 'selected' : '' ?>>Odenigwe</option>
    <option value="Odim" <?= $item['location'] === 'Odim' ? 'selected' : '' ?>>Odim</option>
    <option value="Presidential Road" <?= $item['location'] === 'Presidential Road' ? 'selected' : '' ?>>Presidential Road</option>
  </optgroup>
</select>


    <label>Condition:</label>
    <select name="condition" required>
      <option value="New" <?= $item['condition'] === 'New' ? 'selected' : '' ?>>New</option>
      <option value="Used" <?= $item['condition'] === 'Used' ? 'selected' : '' ?>>Used</option>
    </select>

    <label>Price (₦):</label>
    <input type="number" name="price" value="<?php echo $item['price']; ?>" required>

    <label>Contact:</label>
    <input type="text" name="contact" value="<?php echo htmlspecialchars($item['contact']); ?>" required>

    <label>Description:</label>
    <textarea name="description" rows="4" required><?php echo htmlspecialchars($item['description']); ?></textarea>

    <label>Current Image:</label><br>
    <img src="../assets/images/upload/<?php echo $item['image']; ?>" alt="Current Image" width="150"><br><br>

    <label>Upload New Image (optional):</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">💾 Save Changes</button>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
