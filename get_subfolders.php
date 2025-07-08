<?php
header('Content-Type: application/json');

if (!isset($_GET['class'])) {
    echo json_encode([]);
    exit;
}

$base_dir = 'files';
$class = basename($_GET['class']); // sanitize input
$target_dir = "$base_dir/$class";

$subfolders = [];

if (is_dir($target_dir)) {
    $entries = scandir($target_dir);
    foreach ($entries as $entry) {
        if ($entry !== '.' && $entry !== '..' && is_dir("$target_dir/$entry")) {
            $subfolders[] = $entry;
        }
    }
}

echo json_encode($subfolders);
exit;
?>
