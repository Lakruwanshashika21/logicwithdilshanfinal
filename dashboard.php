<?php
ob_start(); // Start output buffering
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

      <div class="note" style="margin-top: 100px;">
        <h1 style="text-align: center;color: black">Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 👋</h1>
        <p style="text-align: center;color: black"><?php echo htmlspecialchars($_SESSION["user_email"]); ?></p><br><br>
        <h3 style="text-align: center;color: black">What would you like to do?</h3>
        <button><a href="profile.php">Update Your Profile</a></button><br>
        <form action="request_note_access.php" method="post">
       <button type="submit">Request NoteAccess</button>
        </form>

        <button><a href="logout.php">Logout</a></button><br>
        <button><a href="index.php">Go Back</a></button><br>
    </div>
  </div>

  <footer>
    <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
    <p>Author: Shashika Piyumal</p>
    <ul>
      <li><a href="tel:+94771080809"><img src="image/speech_3869725.png" alt="Call" width="30px"></a></li>
      <li><a href="https://wa.me/+94771080809"><img src="image/whatsapp_12635043.png" alt="WhatsApp" width="30px"></a></li>
      <li><a href="https://www.facebook.com/shashika.piyumal.18"><img src="image/communication_15047435.png" alt="Facebook" width="30px"></a></li>
      <li><a href="mailto:lakruwanshashika21@gmail.com"><img src="image/email_5508700.png" alt="Email" width="30px"></a></li>
      <li><a href="https://github.com/Lakruwanshashika21"><img src="image/github_1051326.png" alt="GitHub" width="30px"></a></li>
      <li><a href="https://www.linkedin.com/in/lakruwan-shashika-541661258"><img src="image/linkedin_1377213.png" alt="LinkedIn" width="30px"></a></li>
    </ul>
  </footer>
</body>
<?php ob_end_flush(); ?>
</html>
