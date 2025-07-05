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

 <div id="menubar">
    <nav class="navbar">
      <button class="menu-toggle" onclick="toggleMenu()">☰</button>
      <ul class="menu" id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">Time Table</a></li>
        <li><a href="classpage.php">Note & Papers</a></li>
        <li><a href="index.php">Contact</a></li>
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
        <h2 style="color:red; margin-top: 20px; margin-bottom: 20px; " >⚠️ You do not have access to any class notes.</h2>
    <?php endif; ?>
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

    <script>
    

    // Check session and toggle login/profile
    document.addEventListener("DOMContentLoaded", function () {
  fetch("session_data.php")
    .then(res => res.json())
    .then(data => {
      if (data.logged_in) {
        document.getElementById("authButtons").style.display = "none";
        document.getElementById("userProfile").style.display = "inline-block";
        document.getElementById("welcomeText").innerText = `👋 Hello, ${data.name}`;
      }
    })
    .catch(error => {
      console.error("Session check failed:", error);
      // Let other JS (like toggleMenu) run even if session fails
    });
    });

      function toggleMenu() {
  console.log("Toggle button clicked!");
  const menu = document.getElementById("menu");
  menu.classList.toggle("show");
  console.log("Menu class list:", menu.classList); // 🔍 Add this line
}





    
  </script>

</body>
</html>
