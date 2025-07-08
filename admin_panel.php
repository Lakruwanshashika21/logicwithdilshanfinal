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
        <br><hr><br>
    <h2>Pending Note Access Requests</h2><br>

    <div style="display: flex; justify-content: center;">
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
    </div><br><hr><br>
    <h3>Grant Document Access</h3><br>
    <form action="update_access.php" method="post">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Document Name:</label><br>
        <input type="text" name="document_name" required><br><br>

        <label><input type="checkbox" name="access_notes" value="1" > Grant Access</label><br>

        <button type="submit" class="signup-button">Update Access</button>
    </form><br><hr><br>

    <h3 style="text-align: center;">Current Access Permissions</h3><br>
<div style="display: flex; justify-content: center;">
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Email</th>
        <th>Document</th>
        <th>Access Notes</th>
        <th>Action</th>
    </tr>
    <?php
    $res = $conn->query("SELECT * FROM document_access");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td>" . htmlspecialchars($row['document_name']) . "</td>
            <td>" . ($row['access_notes'] ? '✅ Yes' : '❌ No') . "</td>
            <td>
                <form action='update_access.php' method='post' onsubmit='return confirm(\"Remove this access?\")' style='display:inline;'>
                    <input type='hidden' name='email' value='" . htmlspecialchars($row['email'], ENT_QUOTES) . "'>
                    <input type='hidden' name='document_name' value='" . htmlspecialchars($row['document_name'], ENT_QUOTES) . "'>
                    <input type='hidden' name='remove_access' value='1'>
                    <button type='submit' style='color:red;'>🗑 Delete</button>
                </form>
            </td>
        </tr>";
    }
    ?>
</table>
</div><br><hr><br>

    <h3>Upload Class Document</h3>
    <form id="uploadForm">
        <label>Class Folder:</label><br>
        <select name="class_folder" id="class_folder" required onchange="updateSubfolders()">
            <option value="">-- Select Class --</option>
            <?php
            $base_dir = "files";
            $classes = array_filter(scandir($base_dir), function ($item) use ($base_dir) {
                return $item !== '.' && $item !== '..' && is_dir("$base_dir/$item");
            });
            foreach ($classes as $class) {
                echo "<option value=\"" . htmlspecialchars($class) . "\">$class</option>";
            }
            ?>
        </select><br><br>

        <label>Subfolder:</label><br>
        <select name="sub_folder" id="sub_folder" required>
            <option value="">-- Select Subfolder --</option>
        </select><br><br>

        <label>Select File:</label><br>
        <input type="file" name="fileToUpload" required><br><br>

        <button type="submit" class="signup-button">Upload Document</button>
    </form>

    <div id="uploadResult" style="text-align:center; color:green; font-weight:bold; padding-top:10px;"></div>

   <h3>Uploaded Documents</h3><br>
<div style="display: flex; justify-content: center;">
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Class</th>
        <th>Subfolder</th>
        <th>Filename</th>
        <th>Action</th>
    </tr>
    <?php
    foreach ($classes as $class) {
        $class_path = "$base_dir/$class";
        $subfolders = array_filter(scandir($class_path), function ($item) use ($class_path) {
            return $item !== '.' && $item !== '..' && is_dir("$class_path/$item");
        });

        foreach ($subfolders as $sub) {
            $folder_path = "$class_path/$sub";
            $files = array_diff(scandir($folder_path), ['.', '..']);
            foreach ($files as $file) {
                $file_url = "$folder_path/$file";
                echo "<tr>
                    <td>" . htmlspecialchars($class) . "</td>
                    <td>" . htmlspecialchars($sub) . "</td>
                    <td>" . htmlspecialchars($file) . "</td>
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
    ?>
</table>
</div>
 <br><hr>

    <?php if (isset($_GET['deleted'])): ?>
    <p style="color:green; text-align:center;">✅ File deleted successfully!</p>
    <?php endif; ?>

   <br> <h3>Remove Student Accounts</h3><br>
   <div style="display: flex; justify-content: center;">
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
</div>

<footer>
    <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
    <p>Author: Shashika Piyumal</p>
</footer>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    fetch('upload_document.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('uploadResult').innerText = '✅ File uploaded successfully';
        form.reset();
    })
    .catch(err => {
        document.getElementById('uploadResult').innerText = '❌ Upload failed';
    });
});
</script>

<script>
function updateSubfolders() {
    const classSelect = document.getElementById('class_folder');
    const subFolderSelect = document.getElementById('sub_folder');
    const selectedClass = classSelect.value;

    subFolderSelect.innerHTML = '<option value="">Loading...</option>';

    if (selectedClass !== '') {
        fetch(`get_subfolders.php?class=${encodeURIComponent(selectedClass)}`)
            .then(response => response.json())
            .then(data => {
                subFolderSelect.innerHTML = '<option value="">-- Select Subfolder --</option>';
                data.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    subFolderSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching subfolders:', error);
                subFolderSelect.innerHTML = '<option value="">-- Error loading --</option>';
            });
    } else {
        subFolderSelect.innerHTML = '<option value="">-- Select Subfolder --</option>';
    }
}
</script>

<?php ob_end_flush(); ?>
</body>
</html>
