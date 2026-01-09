<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['flash_error'] = "❌ New passwords do not match.";
        header("Location: profile.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($currentPassword, $user['password'])) {
        $_SESSION['flash_error'] = "❌ Current password is incorrect.";
    } else {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $updateStmt->execute([$hashed, $email]);
        $_SESSION['flash_success'] = "✅ Password changed successfully.";
    }

    header("Location: profile.php");
    exit();
}
?>
