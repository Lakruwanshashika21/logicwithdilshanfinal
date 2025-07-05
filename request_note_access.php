<?php
session_start();
include 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$userId = $_SESSION["user_id"];
$email = $_SESSION["user_email"];

// Check if already requested
$check = $conn->prepare("SELECT * FROM note_requests WHERE student_id = ? AND status = 'pending'");
$check->bind_param("i", $userId);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "You have already requested note access. Please wait for admin approval.";
    exit;
}

// Insert new request
$stmt = $conn->prepare("INSERT INTO note_requests (student_id, email) VALUES (?, ?)");
$stmt->bind_param("is", $userId, $email);
if ($stmt->execute()) {
    echo "✅ Your request has been sent. Wait for admin approval.";
} else {
    echo "❌ Failed to send request.";
}
?>
<br><a href="dashboard.php">🔙 Back to Dashboard</a>
