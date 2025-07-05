<?php
ob_start(); // Start output buffering

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

$requests = $conn->query("SELECT r.id, r.email, r.status, r.request_date, l.name 
                          FROM note_requests r
                          JOIN login l ON r.student_id = l.id
                          WHERE r.status = 'pending'");

$base_dir = "files";
$classes = array_filter(scandir($base_dir), function ($item) use ($base_dir) {
    return $item !== '.' && $item !== '..' && is_dir("$base_dir/$item");
});
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
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
    <button class="signup-button"><a href="?logout=1">Logout</a></button><br>

    <?php if ($is_superadmin): ?>
        <h3>Superadmin Actions</h3>
        <button class="signup-button"><a href="admin_register.php">Add New Admin</a></button>
        <button class="signup-button"><a href="manage_admins.php">Manage Admins</a></button><br>
    <?php else: ?>
        <p>You are a regular admin.</p>
    <?php endif; ?>

    <h2>Pending Note Access Requests</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $requests->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
                <td><?= $row["request_date"] ?></td>
                <td>
                    <form action="handle_note_access.php" method="post" style="display:inline;">
                        <input type="hidden" name="request_id" value="<?= $row["id"] ?>">
                        <input type="hidden" name="email" value="<?= $row["email"] ?>">
                        <button name="action" value="approve">Approve</button>
                        <button name="action" value="reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Grant Document Access</h3>
    <form action="update_access.php" method="post">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Document Name:</label><br>
        <input type="text" name="document_name" required><br><br>

        <label><input type="checkbox" name="access_notes" value="1" > Grant Access</label><br>
        <label><input type="checkbox" name="remove_access" value="1"> Remove Access</label><br><br>

        <button type="submit" class="signup-button">Update Access</button>
    </form>

    <h3>Current Access Permissions</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Email</th>
            <th>Document</th>
            <th>Access Notes</th>
        </tr>
        <?php
        $res = $conn->query("SELECT * FROM document_access");
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['document_name']) . "</td>
                <td>" . ($row['access_notes'] ? '✅ Yes' : '❌ No') . "</td>
            </tr>";
        }
        ?>
    </table>

    <h3>Upload Class Document</h3>
    <form action="upload_document.php" method="post" enctype="multipart/form-data">
        <label>Class Folder:</label><br>
        <select name="class_folder" required>
            <option value="">-- Select Class --</option>
            <?php
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

    <h3>Uploaded Documents</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Class</th>
            <th>Subfolder</th>
            <th>Filename</th>
            <th>Action</th>
        </tr>
        <?php
        $subfolders = ['Answers', 'MIT', 'Model paper', 'Past paper', 'School Paper', 'Tute'];
        foreach ($classes as $class) {
            foreach ($subfolders as $sub) {
                $folder_path = "$base_dir/$class/$sub";
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

    <?php if (isset($_GET['deleted'])): ?>
    <p style="color:green;">✅ File deleted successfully!</p>
    <?php endif; ?>

    <h3>Remove Student Accounts</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th><th>Email</th><th>Action</th>
        </tr>
        <?php
        $students = $conn->query("SELECT id, name, email FROM login");
        while ($s = $students->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($s['name']) . "</td>
                <td>" . htmlspecialchars($s['email']) . "</td>
                <td>
                    <form method='post' action='delete_student.php' onsubmit='return confirm(\"Delete this student?\")'>
                        <input type='hidden' name='student_id' value='" . $s['id'] . "'>
                        <button type='submit'>🗑 Delete</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grantCheckbox = document.querySelector('input[name="access_notes"]');
    const removeCheckbox = document.querySelector('input[name="remove_access"]');

    grantCheckbox.addEventListener('change', function () {
        if (this.checked) removeCheckbox.checked = false;
    });

    removeCheckbox.addEventListener('change', function () {
        if (this.checked) grantCheckbox.checked = false;
    });
});
</script>
</body>
<?php ob_end_flush(); ?>
</html>
