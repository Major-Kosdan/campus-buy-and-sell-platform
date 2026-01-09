<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

$email = $_SESSION['email'];

// Get submitted form data
$id = $_POST['id'] ?? null;
$title = trim($_POST['title']);
$category = trim($_POST['category']);
$location = trim($_POST['location']);
$condition = trim($_POST['condition']);
$price = floatval($_POST['price']);
$contact = trim($_POST['contact']);
$description = trim($_POST['description']);

// Validate ID
if (!$id) {
    $_SESSION['flash_error'] = "Invalid item.";
    header("Location: my_listings.php");
    exit();
}

// Fetch current item to check ownership and image
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ? AND user_email = ?");
$stmt->execute([$id, $email]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    $_SESSION['flash_error'] = "Item not found or unauthorized.";
    header("Location: my_listings.php");
    exit();
}

$imageName = $item['image']; // Keep old image by default

// Handle image upload if a new image is submitted
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image = $_FILES['image'];
    $newImageName = uniqid() . '_' . basename($image['name']);
    $imagePath = '../assets/images/upload/' . $newImageName;
    $imageType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($imageType, $allowedTypes)) {
        $_SESSION['flash_error'] = "Invalid image type. Only JPG, JPEG, PNG, WEBP allowed.";
        header("Location: edit_item.php?id=$id");
        exit();
    }

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        $imageName = $newImageName;

        // Optional: delete old image
        $oldPath = '../assets/images/upload/' . $item['image'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    } else {
        $_SESSION['flash_error'] = "Failed to upload new image.";
        header("Location: edit_item.php?id=$id");
        exit();
    }
}

// Update item
$stmt = $pdo->prepare("UPDATE items SET title = ?, category = ?, location = ?, `condition` = ?, price = ?, contact = ?, description = ?, image = ? WHERE id = ? AND user_email = ?");
$stmt->execute([$title, $category, $location, $condition, $price, $contact, $description, $imageName, $id, $email]);

$_SESSION['flash_success'] = "✅ Item updated successfully!";
header("Location: my_listings.php");
exit();
