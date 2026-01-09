<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $email = $_SESSION['email'];

    if ($newUsername === '') {
        $_SESSION['flash_error'] = "❌ Username cannot be empty.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE email = ?");
            $stmt->execute([$newUsername, $email]);
            $_SESSION['username'] = $newUsername;
            $_SESSION['flash_success'] = "✅ Username updated successfully.";
        } catch (PDOException $e) {
            $_SESSION['flash_error'] = "❌ Something went wrong. Please try again.";
        }
    }
    header("Location: profile.php");
    exit();
}
?>
