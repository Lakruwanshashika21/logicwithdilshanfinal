<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied. Admins only.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class = trim($_POST['class_folder'] ?? '');
    $sub = trim($_POST['sub_folder'] ?? '');
    $file = $_FILES['fileToUpload'] ?? null;

    if (!$class || !$sub || !$file) {
        die("❌ Class, subfolder and file are required.");
    }

    $target_dir = "files/$class/$sub";
    if (!is_dir($target_dir)) {
        die("❌ Target folder does not exist: $target_dir");
    }

    $file_name = basename($file["name"]);
    $target_file = "$target_dir/$file_name";

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "❌ Upload failed.";
    }
}
?>
