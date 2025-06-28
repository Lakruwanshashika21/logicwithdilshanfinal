<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST["name"] ?? '';
    $email    = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    $repass   = $_POST["repassword"] ?? '';
    $gender   = $_POST["gender"] ?? '';
    $address  = $_POST["address"] ?? '';
    $number   = trim($_POST["number"] ?? '');
    $year     = $_POST["admission_year"] ?? '';
    $physical = $_POST["physical"] ?? 'No';
    $class    = $_POST["class"] ?? '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($password) || empty($gender) || empty($repass) || empty($address) || empty($number) || empty($year) || empty($physical) || empty($class)) {
        echo "Please fill all required fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Password match check
    if ($password !== $repass) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if user already exists
    $checkSql = "SELECT id FROM login WHERE email = ?";
    $stmtCheck = $conn->prepare($checkSql);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo "Email is already registered. Please use a different email or login.";
        $stmtCheck->close();
        exit;
    }
    $stmtCheck->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into login table
    $sql = "INSERT INTO login (name, email, password, gender, address, number, year, physical, class)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "SQL error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sssssssss", $name, $email, $hashedPassword, $gender, $address, $number, $year, $physical, $class);

    if ($stmt->execute()) {
        // Registration successful, set session
        $_SESSION["user_id"] = $stmt->insert_id;
        $_SESSION["user_name"] = $name;

        // Redirect to protected page or dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
?>
