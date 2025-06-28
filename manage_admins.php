<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || ($_SESSION['is_superadmin'] ?? 0) != 1) {
    die("Access denied. Superadmin only.");
}

$error = "";
$success = "";

// Handle delete admin
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if ($delete_id == $_SESSION['admin_id']) {
        $error = "You cannot delete yourself.";
    } else {
        $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            $success = "Admin deleted successfully.";
        } else {
            $error = "Failed to delete admin.";
        }
        $stmt->close();
    }
}

// Fetch all admins
$admins = $conn->query("SELECT id, username, is_superadmin, created_at FROM admins ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logic With Dilshan Uthpala</title>
  <link rel="icon" href="image/logic logo.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div id="title">
        <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
        <h1>Logic with Dilshan Uthpala</h1>
    </div>

    <div class="signup">
                    <h2>Manage Admins</h2>
            <p><a href="admin_panel.php">← Back to Admin Panel</a></p>

            <?php if ($error): ?>
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p style="color:green;"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Superadmin</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php while ($admin = $admins->fetch_assoc()): ?>
                    <tr>
                        <td><?= $admin['id'] ?></td>
                        <td><?= htmlspecialchars($admin['username']) ?></td>
                        <td><?= $admin['is_superadmin'] ? 'Yes' : 'No' ?></td>
                        <td><?= $admin['created_at'] ?></td>
                        <td>
                            <?php if (!$admin['is_superadmin']): ?>
                                <a href="?delete=<?= $admin['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            

    </div>
     <footer>
        <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
        <p>Author: Shashika Piyumal</p>
        <ul>
            <li><a href="tel:+94771080809"><img src="image/speech_3869725.png" alt="Call" width="30px" height="30px"></a></li>
            <li><a href="https://wa.me/+94771080809"><img src="image/whatsapp_12635043.png" alt="WhatsApp" width="30px" height="30px"></a></li>
            <li><a href="https://www.facebook.com/shashika.piyumal.18"><img src="image/communication_15047435.png" alt="Facebook"  width="30px" height="30px"></a></li>
            <li><a href="mailto:lakruwanshashika21@gmail.com"><img src="image/email_5508700.png" alt="Email" width="30px" height="30px"></a></li>
            <li><a href="https://github.com/Lakruwanshashika21"><img src="image/github_1051326.png" alt="GitHub" width="30px" height="30px"></a></li>
            <li><a href="https://www.linkedin.com/in/lakruwan-shashika-541661258"><img src="image/linkedin_1377213.png" alt="LinkedIn" width="30px" height="30px"></a></li>
        </ul>
    </footer>

</body>
</html>
