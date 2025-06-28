<?php
// File: edit_profile.php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT name, email, address, number, year, physical, class FROM login WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Logic With Dilshan</title>
  <link rel="icon" href="image/logic logo.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div id="title">
        <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
        <h1>Logic with Dilshan Uthpala</h1>
    </div>

    <div class="signup">
          <h2 class="content">Edit Profile</h2>
        <form action="update_profile.php" method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['number']) ?>"><br><br>

        <label>Address:</label><br>
        <textarea name="address"><?= htmlspecialchars($user['address']) ?></textarea><br><br>

        <label>Admission Year:</label><br>
        <input type="text" name="year" value="<?= htmlspecialchars($user['year']) ?>"><br><br>

        <label for="physical">Physically Attending?</label><br>
        <select name="physical" id="physical">
          <option value="Yes" <?= $user['physical'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
          <option value="No" <?= $user['physical'] === 'No' ? 'selected' : '' ?>>No</option>
        </select><br><br>

        <div id="classContainer" style="display: <?= $user['physical'] === 'Yes' ? 'block' : 'none' ?>;">
          <label for="classIfYes">Select Class (if attending physically)</label>
          <select name="class" id="classIfYes">
            <option value="">-- Select Class --</option>
            <option value="Winds-2027 Theory" <?= $user['class'] === 'Winds-2027 Theory' ? 'selected' : '' ?>>Winds-2027 Theory</option>
            <option value="Winds-2026 Theory" <?= $user['class'] === 'Winds-2026 Theory' ? 'selected' : '' ?>>Winds-2026 Theory</option>
            <option value="Winds-2025 Theory" <?= $user['class'] === 'Winds-2025 Theory' ? 'selected' : '' ?>>Winds-2025 Theory</option>
            <option value="Winds-2025 Revision" <?= $user['class'] === 'Winds-2025 Revision' ? 'selected' : '' ?>>Winds-2025 Revision</option>
          </select><br><br>
        </div>


        <button type="submit" class="signup-button">Update Profile</button>
      </form>
      <p><a href="index.php">&larr; Back to Home</a></p>

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
    document.getElementById("physical").addEventListener("change", function () {
      const classDiv = document.getElementById("classContainer");
      if (this.value === "Yes") {
        classDiv.style.display = "block";
      } else {
        classDiv.style.display = "none";
      }
    });
  </script>
</body>
</html>
