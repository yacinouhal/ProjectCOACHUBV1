<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Admin Action</title>
</head>
<body>
    <div class="container">
        <h1>Update Admin Action</h1>

        <?php
           include '../../../Model/db_connection.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $actionId = $_POST['action_id'];
                    $submissionId = $_POST['submission_id'];
                    $adminUsername = $_POST['admin_username'];
                    $actionDescription = $_POST['action_description'];

                    $sql = "UPDATE adminactions SET submission_id = :submission_id, admin_username = :admin_username, action_description = :action_description WHERE action_id = :action_id";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':action_id', $actionId);
                    $stmt->bindParam(':submission_id', $submissionId);
                    $stmt->bindParam(':admin_username', $adminUsername);
                    $stmt->bindParam(':action_description', $actionDescription);

                    $stmt->execute();

                    echo "Admin action updated successfully.";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                } finally {
                    $conn = null;
                }
            } elseif (isset($_GET['id'])) {
                // Display the existing data in the form for updating
                try {
                    $actionId = $_GET['id'];

                    $sql = "SELECT action_id, submission_id, admin_username, action_description FROM adminactions WHERE action_id = :action_id";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':action_id', $actionId);

                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        
                        echo "<form action='update_action.php' method='post'>

                                <input type='hidden' name='action_id' value='{$row['action_id']}'>
                                <label for='submission_id'>Submission ID:</label>
                                <input type='text' id='submission_id' name='submission_id' value='{$row['submission_id']}' required>
                                
                                <label for='admin_username'>Admin Username:</label>
                                <input type='text' id='admin_username' name='admin_username' value='{$row['admin_username']}' required>
                                
                                <label for='action_description'>Action Description:</label>
                                <textarea id='action_description' name='action_description' rows='4' required>{$row['action_description']}</textarea>
                                
                                <button type='submit'>Update Action</button>
                            </form>";
                    } else {
                        echo "Admin action not found.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                } finally {
                    $conn = null;
                }
            } else {
                echo "Invalid request.";
            }
        ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
