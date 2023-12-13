<?php
 include '../../../Model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        
        $submissionIdQuery = "SELECT submission_id FROM usersubmissions ORDER BY submission_date DESC LIMIT 1";
        $stmtSubmissionId = $conn->prepare($submissionIdQuery);

        if (!$stmtSubmissionId) {
            echo "\nPDO::errorInfo() for submission_id query:\n";
            print_r($conn->errorInfo());
            die();
        }

        $stmtSubmissionId->execute();
        $rowSubmissionId = $stmtSubmissionId->fetch(PDO::FETCH_ASSOC);

        if ($rowSubmissionId) {
            $submissionId = $rowSubmissionId['submission_id'];

           
            $adminUsername = $_POST['admin_username'];
            $actionDescription = $_POST['action_description'];

            
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
        } else {
            echo "No submissions available. Unable to add admin action.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Admin Action</title>
</head>
<body>
    <div class="container">
        <h1>Add Admin Action</h1>

        <form action="add_action.php" method="post">
            <label for="admin_username">Admin Username:</label>
            <input type="text" id="admin_username" name="admin_username" required>

            <label for="action_description">Action Description:</label>
            <textarea id="action_description" name="action_description" rows="4" required></textarea>

            <button type="submit">Add Action</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
