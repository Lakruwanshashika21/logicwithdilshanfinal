<?php
session_start();
include 'config.php';

$error = "";

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_panel.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = "Username and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT id, password, is_superadmin FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $username;
                $_SESSION['is_superadmin'] = (int)$admin['is_superadmin'];

                header("Location: admin_panel.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="icon" href="image/logic logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div id="title">
        <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
        <h1>Logic with Dilshan Uthpala</h1>
    </div>

    <div id="menubar">
    <nav class="navbar">
      <button class="menu-toggle" onclick="toggleMenu()">☰</button>
      <ul class="menu" id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="#TimeTable">Time Table</a></li>
        <li><a href="classpage.php">Note & Papers</a></li>
        <li><a href="#Contact">Contact</a></li>
        <li><a href="#">Announcement</a></li>
      </ul>

      <!-- Guest buttons -->
      <div id="authButtons" style="display: block;">
        <button class="signup-button"><a href="login.html">Login</a></button>
        <button class="signup-button"><a href="Signup.html">Sign Up</a></button>
      </div>

      <!-- User profile (hidden by default) -->
      <div id="userProfile" style="display: none;">
        <span id="welcomeText"></span>
        <a href="dashboard.php">Profile</a> |
        <a href="logout.php">Logout</a>
      </div>
    </nav>
  </div>

<div class="signup">
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" class="signup-button">Login</button>
        <p><a href="login.html">Login as Student</a></p>
    </form>

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
