<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit;
}

$email = $_SESSION['user_email'];
$stmt = $conn->prepare("SELECT document_name FROM document_access WHERE email = ? AND access_notes = 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$accessList = [];
while ($row = $result->fetch_assoc()) {
    $accessList[] = $row['document_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Logic with Dilshan - Notes</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="title">
    <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
    <h1>Logic with Dilshan Uthpala</h1>
</div>

<div class="note">
    <?php if (in_array("2025 Theory", $accessList)): ?>
        <button><a href="25t.html">2025 Theory</a></button><br>
    <?php endif; ?>

    <?php if (in_array("2026 Theory", $accessList)): ?>
        <button><a href="26t.html">2026 Theory</a></button><br>
    <?php endif; ?>

    <?php if (in_array("2027 Theory", $accessList)): ?>
        <button><a href="27t.html">2027 Theory</a></button><br>
    <?php endif; ?>

    <?php if (in_array("2025 Revision", $accessList)): ?>
        <button><a href="25r.html">2025 Revision</a></button><br>
    <?php endif; ?>

    <?php if (in_array("2026 Revision", $accessList)): ?>
        <button><a href="26r.html">2026 Revision</a></button><br>
    <?php endif; ?>

    <?php if (in_array("2027 Revision", $accessList)): ?>
        <button><a href="27r.html">2027 Revision</a></button><br>
    <?php endif; ?>

    <?php if (empty($accessList)): ?>
        <p style="color:red;">⚠️ You do not have access to any class notes.</p>
    <?php endif; ?>
</div>

</body>
</html>
