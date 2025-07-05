<?php
// === config.php ===
$host = "localhost";
$user = "root";
$password = "";
$dbname = "logicuser";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET time_zone = '+05:30'");
?>



<?php
/*

// === infinityfree data base ===
// === config.php ===
$host = "sql309.infinityfree.com";
$user = "if0_39339687";
$password = "Lsp70576580";
$dbname = "if0_39339687_logicuser";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set MySQL timezone to Sri Lanka time
$conn->query("SET time_zone = '+05:30'");

?>*/


