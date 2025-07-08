<?php
$folderPath = realpath(__DIR__ . '/../files/2027 revision/MIT');
$files = [];
$folderNotFound = false;

if ($folderPath && is_dir($folderPath)) {
    $scan = scandir($folderPath);
    $files = array_values(array_diff($scan, ['.', '..']));
} else {
    $folderNotFound = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logic with Dilshan</title>
    <link rel="icon" href="../image/logic logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
    <div id="title">
        <img src="../image/logic logo.png" alt="Logo" width="50" height="50" />
        <h1>Logic with Dilshan Uthpala</h1>
    </div>

    <div id="menubar">
        <nav class="navbar">
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
            <ul class="menu" id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../index.php">Time Table</a></li>
                <li><a href="../classpage.php">Note & Papers</a></li>
                <li><a href="../index.php">Contact</a></li>
                <li><a href="#">Announcement</a></li>
            </ul>
        </nav>
    </div>

    <div class="note" style="text-align:center; margin-top: 200px;">
        <?php if ($folderNotFound): ?>
            <h3 style="color:red;">⚠️ Folder "<?= htmlspecialchars('../files/2027 revision/MIT') ?>" does not exist.</h3>
        <?php elseif (empty($files)): ?>
            <h3 style="color:red;">⚠️ No files found in the MIT folder.</h3>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
                <button>
                    <a href="<?= '../files/2027 revision/MIT/' . rawurlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
        <p>Author: Shashika Piyumal</p>
        <ul>
            <li><a href="tel:+94771080809"><img src="../image/speech_3869725.png" alt="Call" width="30" height="30" /></a></li>
            <li><a href="https://wa.me/+94771080809"><img src="../image/whatsapp_12635043.png" alt="WhatsApp" width="30" height="30" /></a></li>
            <li><a href="https://www.facebook.com/shashika.piyumal.18"><img src="../image/communication_15047435.png" alt="Facebook" width="30" height="30" /></a></li>
            <li><a href="mailto:lakruwanshashika21@gmail.com"><img src="../image/email_5508700.png" alt="Email" width="30" height="30" /></a></li>
            <li><a href="https://github.com/Lakruwanshashika21"><i
