<?php
session_start();
$success = $_SESSION['flash_success'] ?? null;
$error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
require 'includes/mailer_config.php'; // your mail config
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

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
        $mail->addAddress('kossydaniel2021@gmail.com', 'UNNify Admin'); 


        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body    = "<strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br>
                          <strong>Message:</strong><br>$message";

        if ($mail->send()) {
                $_SESSION['flash_success'] = "Thanks! We'll get back to you soon.";
            } else {
                $_SESSION['flash_error'] = "Message could not be sent. Please try again.";
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = "Mailer Error: " . $mail->ErrorInfo;
        }
        header("Location: contact.php");
        exit();
}
?>


<?php include 'includes/header.php'; ?>


<div class="container" style="max-width: 600px; margin: auto;">
  <h2>Contact Us</h2>
  <p style="margin-bottom: 1rem;">Have a question or feedback? Contact the UNNify Team using the form below.</p>
  <?php if ($success): ?>
  <div class="alert success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="alert error"><?php echo $error; ?></div>
<?php endif; ?>
  <form method="post" class="contact-form" style="display: flex; flex-direction: column; gap: 1rem;">
    <input type="text" name="name" placeholder="Your Name" required style="padding: 10px;">
    <input type="email" name="email" placeholder="Your Email" required style="padding: 10px;">
    <textarea name="message" rows="5" placeholder="Your Message" required style="padding: 10px;"></textarea>
    <button type="submit" style="padding: 10px; background: var(--primary); color: white; border: none;">Send Message</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
<script>
  const alertBox = document.querySelector('.alert');
  if (alertBox) {
    setTimeout(() => {
      alertBox.style.opacity = '0';
      setTimeout(() => alertBox.style.display = 'none', 500);
    }, 3000); // fades out after 3s
  }
</script>
