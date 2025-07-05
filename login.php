<?php
date_default_timezone_set('Asia/Colombo');

session_start();
include 'config.php';

// Import PHPMailer classes
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        showError("Email and password are required.");
    }

    $stmt = $conn->prepare("SELECT id, name, email, password FROM login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            // Send login notification email BEFORE redirect
            $user_email = $user["email"];
            $user_name = $user["name"];

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dilshanuthpalalogic@gmail.com';   // your Gmail
                $mail->Password   = 'tebp klcm gexh jhuy';         // your Gmail App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('dilshanuthpalalogic@gmail.com', 'Logic With Dilshan Uthpala');
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = 'Login Notification';
                $mail->Body    = "Hi $user_name,<br>You just logged into your Logic account on " . date("Y-m-d H:i:s") . ".";

                $mail->send();
            } catch (Exception $e) {
                error_log("Login email failed: " . $mail->ErrorInfo);
            }

            // Set session and redirect after email sent
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];

            header("Location: index.php");
            exit;
        } else {
            showError("❌ Invalid email or password.");
        }
    } else {
        showError("❌ Invalid email or password.");
    }
} else {
    showError("❌ Invalid request method.");
}

// === HTML styled error display function ===
function showError($message) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Login Error</title>
        <style>
            body { font-family: Arial; background-color: #fefefe; padding: 20px; }
            .error-box {
                border: 1px solid #ccc;  
                padding: 20px;
                border-radius: 5px;
                background-color: #f2f2f2;
                max-width: 600px;
                margin: 0 auto;
                text-align: center;
            }
            .error-box h3 { color: red; }
        </style>
    </head>
    <body>
        <div class='error-box'>
            <h3>Login Failed</h3>
            <p>$message</p>
            <p><a href='login.php'>🔙 Back to Login</a></p>
        </div>
    </body>
    </html>";
    exit;
}
?>
