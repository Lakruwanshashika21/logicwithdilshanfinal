<?php
include 'config.php';

$username = "superadmin";  // Change this to your desired superadmin username
$password_plain = "supersecurepassword"; // Change this to a strong password you want
$is_superadmin = 1;

$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password, is_superadmin) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $username, $hashed_password, $is_superadmin);

if ($stmt->execute()) {
    echo "✅ Superadmin created successfully. Username: $username";
} else {
    echo "❌ Failed to create superadmin. Error: " . $stmt->error;
}

$stmt->close();
?>
