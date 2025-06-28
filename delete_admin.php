<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_superadmin']) || $_SESSION['is_superadmin'] != 1) {
    die("Access denied.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['admin_id'])) {
    $id = intval($_POST['admin_id']);
    $conn->query("DELETE FROM admin WHERE id = $id AND is_superadmin = 0");
    header("Location: manage_admins.php");
    exit;
}
?>
