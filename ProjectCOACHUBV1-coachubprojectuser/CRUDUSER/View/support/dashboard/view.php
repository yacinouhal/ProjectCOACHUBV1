<?php
 include '../../../Model/db_connection.php';

include'delete.php';

try {
    $stmt = $conn->prepare("SELECT * FROM usersubmissions");
    $stmt->execute();
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container admin">
        <h1>Admin Dashboard - All Submissions</h1>

        <?php foreach ($submissions as $submission): ?>
            <div class="submission">
                <h2>Submission #<?php echo $submission['submission_id']; ?></h2>
                <p><strong>Name:</strong> <?php echo $submission['name']; ?></p>
                <p><strong>Contact:</strong> <?php echo $submission['contact']; ?></p>
                <p><strong>Problem Description:</strong> <?php echo $submission['problem_description']; ?></p>
                <p><strong>Submission Date:</strong> <?php echo $submission['submission_date']; ?></p>

<form action="reply.php" method="post">
    <input type="hidden" name="submission_id" value="<?php echo $submission['submission_id']; ?>">

    <label for="admin_username">Admin Username:</label>
    <input type="text" id="admin_username" name="admin_username">

    <label for="action_description">Action Description:</label>
    <textarea id="action_description" name="action_description" rows="4" required></textarea>

    <button type="submit">Reply</button>
</form>


                <form class="delete-form" action="" method="post">
                    <input type="hidden" name="submission_id" value="<?php echo $submission['submission_id']; ?>">
                    <button type="submit">&times;</button>
                </form>

            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
