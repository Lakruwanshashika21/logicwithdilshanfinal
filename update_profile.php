<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$id = $_SESSION['user_id'];
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$year = trim($_POST['year'] ?? '');
$physical = $_POST['physical'] ?? 'No';
$class = $physical === 'Yes' ? ($_POST['class'] ?? '') : '';

if (empty($name) || empty($phone) || empty($address) || empty($year)) {
    echo "All fields are required.";
    exit;
}

$stmt = $conn->prepare("UPDATE login SET name = ?, number = ?, address = ?, year = ?, physical = ?, class = ? WHERE id = ?");
$stmt->bind_param("ssssssi", $name, $phone, $address, $year, $physical, $class, $id);

if ($stmt->execute()) {
    // Optionally update session name
    $_SESSION["user_name"] = $name;
    header("Location: dashboard.php?updated=1");
    exit;
} else {
    echo "Failed to update profile.";
}

$stmt->close();
$conn->close();
?>
