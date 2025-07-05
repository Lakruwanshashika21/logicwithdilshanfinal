<?php
session_start();
include 'config.php';

// Check admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'] ?? null;
    $email = $_POST['email'] ?? '';
    $action = $_POST['action'] ?? '';

    if (!$request_id || !$email || !$action) {
        die("Missing required information.");
    }

    // Approve
    if ($action === 'approve') {
        // 1. Update status
        $conn->query("UPDATE note_requests SET status = 'approved' WHERE id = $request_id");

        // 2. Grant access in document_access table
        $doc_name = 'ALL'; // or customize
        $stmt = $conn->prepare("INSERT INTO document_access (email, document_name, access_notes)
                                VALUES (?, ?, 1)
                                ON DUPLICATE KEY UPDATE access_notes = 1");
        $stmt->bind_param("ss", $email, $doc_name);
        $stmt->execute();

        // 3. Send email
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'lakruwanshashika22@gmail.com';
            $mail->Password = 'yjcm qlqk wncl rscn';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('lakruwanshashika22@gmail.com', 'Logic Site');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Note Access Approved';
            $mail->Body = "You have been granted access to class documents. Please log in to view them.";

            $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }

        header("Location: admin_panel.php?msg=approved");
        exit;

    } elseif ($action === 'reject') {
        // Just update request status
        $conn->query("UPDATE note_requests SET status = 'rejected' WHERE id = $request_id");
        header("Location: admin_panel.php?msg=rejected");
        exit;

    } else {
        die("Invalid action.");
    }
}
?>
