<?php
session_start();
include 'config.php';

// Only super admins can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || !$_SESSION['is_superadmin']) {
    die("Access denied. Superadmin only.");
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $is_superadmin = isset($_POST['is_superadmin']) ? 1 : 0;

    if (!$username || !$password) {
        $error = "Username and password are required.";
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            $stmt->close();

            // Insert new admin with hashed password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO admins (username, password, is_superadmin) VALUES (?, ?, ?)");
            $insert->bind_param("ssi", $username, $hashedPassword, $is_superadmin);

            if ($insert->execute()) {
                $success = "New admin created successfully.";
            } else {
                $error = "Failed to create admin.";
            }
            $insert->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register New Admin</title>
    <link rel="icon" href="image/logic logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <div id="title">
        <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
        <h1>Logic with Dilshan Uthpala</h1>
    </div>
    
    <div class="signup">
        <h2>Register New Admin</h2>

         <?php if ($error): ?>
             <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($success): ?>
            <p style="color:green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <label><input type="checkbox" name="is_superadmin"> Make Super Admin</label><br><br>

            <button type="submit" class="signup-button">Register Admin</button>
        </form>

        <p><a href="admin_panel.php">Back to Admin Panel</a></p>

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
