<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied.");
}

$baseDir = __DIR__ . '/files/';
$newFolder = trim($_POST['new_folder_name'] ?? '');

if ($newFolder !== '') {
    $folderPath = $baseDir . basename($newFolder);

    if (!file_exists($folderPath)) {
        if (mkdir($folderPath, 0775, true)) {
            echo "✅ Folder '$newFolder' created successfully.";
        } else {
            echo "❌ Failed to create folder.";
        }
    } else {
        echo "⚠️ Folder already exists.";
    }
} else {
    echo "❌ Folder name cannot be empty.";
}
?>
<br><a href="admin_panel.php">🔙 Back to Admin Panel</a>
