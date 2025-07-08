<?php
session_start();

include 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Access denied. Admins only.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $document_name = $_POST['document_name'] ?? '';

    if (isset($_POST['remove_access'])) {
        // Remove access
        $stmt = $conn->prepare("DELETE FROM document_access WHERE email = ? AND document_name = ?");
        $stmt->bind_param("ss", $email, $document_name);
        if ($stmt->execute()) {
            echo "🗑️ Access removed for $email on document $document_name.";
        } else {
            echo "❌ Failed to remove access.";
        }
        $stmt->close();
    } else {
        // Add or update access
        $access_notes = isset($_POST['access_notes']) ? (int)$_POST['access_notes'] : 0;

        $stmt = $conn->prepare("REPLACE INTO document_access (email, document_name, access_notes) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $email, $document_name, $access_notes);

        if ($stmt->execute()) {
            echo "✅ Access updated for $email.";

            $subject = "Note Access Updated";
            $message = "You have been granted access to: $document_name";
            $headers = "From: dilshanuthpalalogic@gmail.com";

            mail($email, $subject, $message, $headers);

        } else {
            echo "❌ Failed to update access.";
        }
        $stmt->close();
    }
} else {
    echo "Invalid request method.";
}



?>
