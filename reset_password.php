<?php
session_start();
include 'config.php';

$enteredOtp = $_POST['otp'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$sessionOtp = $_SESSION['otp'] ?? '';
$email = $_SESSION['reset_email'] ?? '';

if ($enteredOtp != $sessionOtp) {
    die("❌ Invalid OTP.");
}

if ($newPassword !== $confirmPassword) {
    die("❌ Passwords do not match.");
}

$hashed = password_hash($newPassword, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE login SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashed, $email);
if ($stmt->execute()) {
    unset($_SESSION['otp'], $_SESSION['reset_email']);
    echo "✅ Password reset successfully! <a href='login.html'>Login Now</a>";
} else {
    echo "❌ Failed to update password.";
}

$stmt->close();
$conn->close();
?>
