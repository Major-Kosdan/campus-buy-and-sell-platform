<?php
require_once '../includes/db.php';

if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $_GET['email'];
    $code = $_GET['code'];

    try {
        // Prepare the query to check if the user exists and is not yet verified
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND verification_code = :code AND is_verified = 0");
        $stmt->execute([
            ':email' => $email,
            ':code' => $code
        ]);

        if ($stmt->rowCount() === 1) {
            // User found, now update the verification status
            $updateStmt = $pdo->prepare("UPDATE users SET is_verified = 1, verification_code = '' WHERE email = :email");
            $updateStmt->execute([':email' => $email]);

            echo "
    <div style='
        max-width: 500px;
        margin: 80px auto;
        padding: 30px;
        background-color: #f0f8ff;
        border-radius: 10px;
        text-align: center;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    '>
        <h2 style='color: #007b5e; margin-bottom: 10px;'>✅ Email Successfully Verified!</h2>
        <p style='font-size: 17px; color: #333;'>Your account has been verified. You can now log in to start using UNNify Marketplace.</p>
        <a href='login.php' style='
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #007b5e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        ' onmouseover='this.style.backgroundColor=\"#005d48\"' onmouseout='this.style.backgroundColor=\"#007b5e\"'>
            Go to Login
        </a>
    </div>
";
        } else {
            echo "<h2>Invalid or expired verification link.</h2>";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "<h2>Invalid request.</h2>";
}
?>
