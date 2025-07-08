<?php
ob_start();
session_start();
include 'config.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit;
}

$email = $_SESSION['user_email'];

// Get list of allowed QA documents
$accessQA = [];
$stmt = $conn->prepare("SELECT document_name FROM document_access WHERE email = ? AND access_notes = 1");
if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $doc = strtolower($row['document_name']);
        if (strpos($doc, 'qa-') === 0) {
            $accessQA[] = $doc;
        }
    }
    $stmt->close();
}

// Helper to get all files in folder
function getAllFiles($path) {
    if (!is_dir($path)) return [];
    $files = scandir($path);
    return array_values(array_diff($files, ['.', '..']));
}

$lesson01Files = getAllFiles("files/Question_Answer/lesson01");
$lesson02Files = getAllFiles("files/Question_Answer/lesson02");
$lesson03Files = getAllFiles("files/Question_Answer/lesson03");
$lesson04Files = getAllFiles("files/Question_Answer/lesson04");
$lesson05Files = getAllFiles("files/Question_Answer/lesson05");
$lesson06Files = getAllFiles("files/Question_Answer/lesson06");
$lesson07Files = getAllFiles("files/Question_Answer/lesson07");
$lesson08Files = getAllFiles("files/Question_Answer/lesson08");
$lesson09Files = getAllFiles("files/Question_Answer/lesson09");
$lesson10Files = getAllFiles("files/Question_Answer/lesson10");
$lesson11Files = getAllFiles("files/Question_Answer/lesson11");
$lesson12Files = getAllFiles("files/Question_Answer/lesson12");
$lesson13Files = getAllFiles("files/Question_Answer/lesson13");
$lesson14Files = getAllFiles("files/Question_Answer/lesson14");
$lesson15Files = getAllFiles("files/Question_Answer/lesson15");
$lesson16Files = getAllFiles("files/Question_Answer/lesson16");
$lesson17Files = getAllFiles("files/Question_Answer/lesson17");
$lesson18Files = getAllFiles("files/Question_Answer/lesson18");
$lesson19Files = getAllFiles("files/Question_Answer/lesson19");
$lesson20Files = getAllFiles("files/Question_Answer/lesson20");
$lesson21Files = getAllFiles("files/Question_Answer/lesson21");
$lesson22Files = getAllFiles("files/Question_Answer/lesson22");
$lesson23Files = getAllFiles("files/Question_Answer/lesson23");
$lesson24Files = getAllFiles("files/Question_Answer/lesson24");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logic with Dilshan - Answers</title>
    <link rel="icon" href="image/logic logo.png" type="image/x-icon">
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
        </nav>
    </div>

    <div class="note" style="text-align:center; margin-top: 200px;">

        <?php if (in_array("qa-01", $accessQA) && !empty($lesson01Files)): ?>
            <h2>Lesson 01</h2>
            <?php foreach ($lesson01Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson01/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-02", $accessQA) && !empty($lesson02Files)): ?>
            <h2>Lesson 02</h2>
            <?php foreach ($lesson02Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson02/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-03", $accessQA) && !empty($lesson03Files)): ?>
            <h2>Lesson 03</h2>
            <?php foreach ($lesson03Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson03/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-04", $accessQA) && !empty($lesson04Files)): ?>
            <h2>Lesson 04</h2>
            <?php foreach ($lesson04Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson04/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if (in_array("qa-05", $accessQA) && !empty($lesson05Files)): ?>
            <h2>Lesson 05</h2>
            <?php foreach ($lesson04Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson05/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-06", $accessQA) && !empty($lesson06Files)): ?>
            <h2>Lesson 06</h2>
            <?php foreach ($lesson06Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson06/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-07", $accessQA) && !empty($lesson07Files)): ?>
            <h2>Lesson 07</h2>
            <?php foreach ($lesson07Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson04/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-08", $accessQA) && !empty($lesson08Files)): ?>
            <h2>Lesson 04</h2>
            <?php foreach ($lesson08Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson08/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-09", $accessQA) && !empty($lesson09Files)): ?>
            <h2>Lesson 04</h2>
            <?php foreach ($lesson09Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson09/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-10", $accessQA) && !empty($lesson10Files)): ?>
            <h2>Lesson 10</h2>
            <?php foreach ($lesson10Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson10/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-11", $accessQA) && !empty($lesson11Files)): ?>
            <h2>Lesson 11</h2>
            <?php foreach ($lesson11Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson11/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-12", $accessQA) && !empty($lesson12Files)): ?>
            <h2>Lesson 12</h2>
            <?php foreach ($lesson12Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson12/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-13", $accessQA) && !empty($lesson13Files)): ?>
            <h2>Lesson 13</h2>
            <?php foreach ($lesson13Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson13/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-14", $accessQA) && !empty($lesson14Files)): ?>
            <h2>Lesson 14</h2>
            <?php foreach ($lesson14Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson14/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-15", $accessQA) && !empty($lesson15Files)): ?>
            <h2>Lesson 15</h2>
            <?php foreach ($lesson15Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson15/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-16", $accessQA) && !empty($lesson16Files)): ?>
            <h2>Lesson 16</h2>
            <?php foreach ($lesson16Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson16/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-17", $accessQA) && !empty($lesson17Files)): ?>
            <h2>Lesson 17</h2>
            <?php foreach ($lesson17Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson17/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-18", $accessQA) && !empty($lesson18Files)): ?>
            <h2>Lesson 18</h2>
            <?php foreach ($lesson18Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson18/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-19", $accessQA) && !empty($lesson19Files)): ?>
            <h2>Lesson 19</h2>
            <?php foreach ($lesson19Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson19/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-20", $accessQA) && !empty($lesson20Files)): ?>
            <h2>Lesson 20</h2>
            <?php foreach ($lesson20Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson20/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-21", $accessQA) && !empty($lesson21Files)): ?>
            <h2>Lesson 21</h2>
            <?php foreach ($lesson21Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson21/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-22", $accessQA) && !empty($lesson22Files)): ?>
            <h2>Lesson 22</h2>
            <?php foreach ($lesson22Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson22/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-23", $accessQA) && !empty($lesson23Files)): ?>
            <h2>Lesson 23</h2>
            <?php foreach ($lesson23Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson23/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (in_array("qa-24", $accessQA) && !empty($lesson24Files)): ?>
            <h2>Lesson 24</h2>
            <?php foreach ($lesson24Files as $file): ?>
                <button>
                    <a href="files/Question_Answer/lesson24/<?= urlencode($file) ?>" target="_blank">
                        <?= htmlspecialchars($file) ?>
                    </a>
                </button><br><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (empty($accessQA)): ?>
            <h2 style="color:red;">⚠️ You do not have access to any answer lessons.</h2>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
        <p>Author: Shashika Piyumal</p>
        <ul>
            <li><a href="tel:+94771080809"><img src="image/speech_3869725.png" alt="Call" width="30px" height="30px"></a></li>
            <li><a href="https://wa.me/+94771080809"><img src="image/whatsapp_12635043.png" alt="WhatsApp" width="30px" height="30px"></a></li>
            <li><a href="https://www.facebook.com/shashika.piyumal.18"><img src="image/communication_15047435.png" alt="Facebook" width="30px" height="30px"></a></li>
            <li><a href="mailto:lakruwanshashika21@gmail.com"><img src="image/email_5508700.png" alt="Email" width="30px" height="30px"></a></li>
            <li><a href="https://github.com/Lakruwanshashika21"><img src="image/github_1051326.png" alt="GitHub" width="30px" height="30px"></a></li>
            <li><a href="https://www.linkedin.com/in/lakruwan-shashika-541661258"><img src="image/linkedin_1377213.png" alt="LinkedIn" width="30px" height="30px"></a></li>
        </ul>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("show");
        }
    </script>
</body>
<?php ob_end_flush(); ?>
</html>
