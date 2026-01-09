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
    $_SESSION['flash_error'] = "Invalid request.";
    header("Location: my_listings.php");
    exit();
}

// Get the item to delete
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ? AND user_email = ?");
$stmt->execute([$item_id, $email]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    $_SESSION['flash_error'] = "Item not found or not authorized.";
    header("Location: my_listings.php");
    exit();
}

// Delete image file
$imagePath = '../assets/images/upload/' . $item['image'];
if (file_exists($imagePath)) {
    unlink($imagePath);
}

// Delete from DB
$stmt = $pdo->prepare("DELETE FROM items WHERE id = ? AND user_email = ?");
$stmt->execute([$item_id, $email]);

$_SESSION['flash_success'] = "🗑️ Item deleted successfully.";
header("Location: my_listings.php");
exit();
