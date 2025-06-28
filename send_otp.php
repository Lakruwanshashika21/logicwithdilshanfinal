<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $otp = rand(100000, 999999);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $_SESSION['reset_email'] = $email;
        $_SESSION['otp'] = $otp;

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'lakruwanshashika22@gmail.com';  // your Gmail
            $mail->Password   = 'yjcm qlqk wncl rscn';    // your App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('lakruwanshashika22@gmail.com', 'Logic With Dilshan');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'OTP for Password Reset';
            $mail->Body    = "Your OTP is: <b>$otp</b>";
            $mail->AltBody = "Your OTP is: $otp";

            $mail->send();
            header("Location: verify_otp.html");
            exit;
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
