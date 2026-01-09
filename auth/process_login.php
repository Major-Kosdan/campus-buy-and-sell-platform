<?php
session_start();
require_once '../includes/db.php';

// Get form input
$email = trim($_POST['email']);
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: login.php?error=Email is not registered");
        exit();
    }

    // Check if account is verified
    if (!$user['is_verified']) {
        header("Location: login.php?error=Please verify your email first");
        exit();
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        header("Location: login.php?error=Incorrect password");
        exit();
    }

    // Login successful — store session data
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    header("Location: ../dashboard.php");
    exit();

} catch (PDOException $e) {
    header("Location: login.php?error=Something went wrong");
    exit();
}
