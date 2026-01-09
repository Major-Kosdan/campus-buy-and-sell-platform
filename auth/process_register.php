<?php
session_start();
require_once '../includes/db.php'; // your DB connection
require '../includes/mailer_config.php'; // your mail config

//  Load PHPMailer classes (manual setup)
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//  Grab form data
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_type = $_POST['user_type'];

//  Check for UNN email
if (!preg_match("/@unn\.edu\.ng$/", $email)) {
    header("Location: register.php?error=Only UNN emails allowed");
    exit();
}

// Check if email already exists
$checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$checkEmail->execute([$email]);

if ($checkEmail->rowCount() > 0) {
    header("Location: register.php?error=Email is already registered");
    exit();
}

//  Check password match
if ($password !== $confirm_password) {
    header("Location: register.php?error=Passwords do not match");
    exit();
}

//  Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//  Generate verification code
$verificationCode = rand(100000, 999999);

//  Save user to DB (unverified)
$stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_code, is_verified, role, user_type) VALUES (?, ?, ?, ?, 0, 'user', ?)");
$stmt->execute([$username, $email, $hashedPassword, $verificationCode, $user_type]);

//  Send email
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Recipients
    $mail->setFrom(MAIL_USER, 'UNNify Marketplace');
    $mail->addAddress($email, $username);

    // Construct the verification link
    $verificationLink = "http://localhost/campus_buy_and_sell/auth/verify_email.php?email=$email&code=$verificationCode";
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Verify Your UNNify Account';
    $mail->Body = "
    <h3>Hello $username,</h3>
    <p>Click the button below to verify your account:</p>
    <p>
        <a href='$verificationLink' style='
            background-color: #007b5e;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        '>Verify My Account</a>
    </p>
    <p>If the button doesn't work, copy and paste this link into your browser:</p>
    <p>$verificationLink</p>
    <p>Regards,<br>UNNify Team</p>
";
    $mail->send();
    if ($mail->send()) {
    echo "
    <div style='
        max-width: 500px;
        margin: 80px auto;
        padding: 30px;
        background-color: #e6fff2;
        border-left: 6px solid #28a745;
        border-radius: 10px;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        text-align: center;
    '>
        <h2 style='color: #28a745;'>📩 Email Sent Successfully</h2>
        <p style='color: #333;'>A verification link has been sent to <strong>$email</strong>.</p>
        <p style='font-size: 15px;'>Please check your inbox (and spam folder) to complete your registration.</p>
    </div>
    ";
} else {
    echo "
    <div style='
        max-width: 500px;
        margin: 80px auto;
        padding: 30px;
        background-color: #fff4f4;
        border-left: 6px solid #dc3545;
        border-radius: 10px;
        font-family: Arial, sans-serif;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        text-align: center;
    '>
        <h2 style='color: #dc3545;'>❌ Failed to Send Email</h2>
        <p style='color: #333;'>Mailer Error: " . $mail->ErrorInfo . "</p>
        <p>Please try again or contact support.</p>
    </div>
    ";
}
exit();


} catch (Exception $e) {
    $errorMsg = urlencode("Mailer Error: " . $mail->ErrorInfo);
    header("Location: register.php?error=$errorMsg");
    exit();

}
