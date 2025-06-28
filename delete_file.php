<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_path = $_POST['file_path'] ?? '';

    // Validate the file path to prevent security issues
    if (strpos($file_path, 'files/') !== 0 || !file_exists($file_path)) {
        die("❌ Invalid file path.");
    }

    if (unlink($file_path)) {
        header("Location: admin_panel.php?deleted=1");
        exit;
    } else {
        die("❌ Failed to delete file.");
    }
}
?>
