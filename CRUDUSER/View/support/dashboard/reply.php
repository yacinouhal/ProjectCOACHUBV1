<?php
 include '../../../Model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get the submission_id from the form
        $submissionId = filter_input(INPUT_POST, 'submission_id', FILTER_VALIDATE_INT);

        // Validate and sanitize input data
        $adminUsername = filter_input(INPUT_POST, 'admin_username', FILTER_SANITIZE_STRING);
        $actionDescription = filter_input(INPUT_POST, 'action_description', FILTER_SANITIZE_STRING);

        // Check if submission_id is valid
        if ($submissionId === false) {
            echo "Invalid submission ID.";
            exit();
        }

        // Insert the admin action
        $sql = "INSERT INTO adminactions (submission_id, admin_username, action_description) VALUES (:submission_id, :admin_username, :action_description)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':submission_id', $submissionId);
        $stmt->bindParam(':admin_username', $adminUsername);
        $stmt->bindParam(':action_description', $actionDescription);

        if ($stmt->execute()) {
            echo "Admin action added successfully.";
        } else {
            echo "Error inserting admin action: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    echo "Invalid request method.";
}
?>
