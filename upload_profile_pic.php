<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: auth/login.php");
    exit();
}

$email = $_SESSION['email'];

// Check if the file was uploaded
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileTmp = $_FILES['profile_pic']['tmp_name'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($ext, $allowed)) {
        $newName = uniqid('profile_', true) . '.' . $ext;
        $destination = "assets/images/" . $newName;

        if (move_uploaded_file($fileTmp, $destination)) {
            // Update user's profile_pic in DB
            $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE email = ?");
            $stmt->execute([$newName, $email]);

            $_SESSION['flash_success'] = "Profile picture updated successfully!";
        } else {
            $_SESSION['flash_error'] = "Failed to upload image.";
        }
    } else {
        $_SESSION['flash_error'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
} else {
    $_SESSION['flash_error'] = "No file uploaded or unknown error.";
}

header("Location: dashboard.php");
exit();
