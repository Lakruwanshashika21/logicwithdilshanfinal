<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in'])) die("Access denied.");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['student_id'])) {
    $id = intval($_POST['student_id']);
    $conn->query("DELETE FROM login WHERE id = $id");
    header("Location: admin_panel.php");
    exit;
}
?>
