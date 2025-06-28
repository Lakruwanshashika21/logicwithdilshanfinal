<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied.");
}

$is_superadmin = $_SESSION['is_superadmin'] ?? 0;
$admin_username = $_SESSION['admin_username'] ?? 'Admin';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document Manager</title>
    <link rel="icon" href="image/logic logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="title">
    <img src="image/logic logo.png" alt="Logo" width="50px" height="50px">
    <h1>Logic with Dilshan Uthpala</h1>
</div>

<div class="signup">
    <h2>Welcome, <?= htmlspecialchars($admin_username) ?>!</h2>
    <button class="signup-button"><a href="admin_panel.php">Admin Panel</a></button>
    <button class="signup-button"><a href="?logout=1">Logout</a></button><br><br>

    <h3>📄 Upload Class Document</h3>
    <form action="upload_document.php" method="post" enctype="multipart/form-data">
        <label>Class Folder:</label><br>
        <select name="class_folder" required>
            <option value="">-- Select Class --</option>
            <?php
            $base_dir = "files/class file";
            $classes = array_filter(scandir($base_dir), function ($item) use ($base_dir) {
                return $item !== '.' && $item !== '..' && is_dir("$base_dir/$item/class doc file");
            });
            foreach ($classes as $class) {
                echo "<option value=\"" . htmlspecialchars($class) . "\">$class</option>";
            }
            ?>
        </select><br><br>

        <label>Subfolder:</label><br>
        <select name="sub_folder" required>
            <option value="">-- Select Subfolder --</option>
            <option value="Answers">Answers</option>
            <option value="MIT">MIT</option>
            <option value="Model paper">Model paper</option>
            <option value="Past paper">Past paper</option>
            <option value="School Paper">School Paper</option>
            <option value="Tute">Tute</option>
        </select><br><br>

        <label>Select File:</label><br>
        <input type="file" name="fileToUpload" required><br><br>

        <button type="submit" class="signup-button">Upload Document</button>
    </form>

    <h3>📙 Uploaded Documents</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Class</th>
            <th>Subfolder</th>
            <th>Filename</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($classes as $class) {
            $subfolders = ['Answers', 'MIT', 'Model paper', 'Past paper', 'School Paper', 'Tute'];
            foreach ($subfolders as $sub) {
                $folder_path = "$base_dir/$class/class doc file/$sub";
                if (is_dir($folder_path)) {
                    $files = array_diff(scandir($folder_path), ['.', '..']);
                    foreach ($files as $file) {
                        $file_url = "$folder_path/$file";
                        echo "<tr>
                            <td>$class</td>
                            <td>$sub</td>
                            <td>$file</td>
                            <td>
                                <a href='$file_url' target='_blank'>View</a> |
                                <form action='delete_file.php' method='post' style='display:inline;' onsubmit='return confirm(\"Delete this file?\")'>
                                    <input type='hidden' name='file_path' value='" . htmlspecialchars($file_url, ENT_QUOTES) . "'>
                                    <button type='submit' style='color:red;'>🗑 Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                }
            }
        }
        ?>
    </table>
</div>
</body>
</html>
