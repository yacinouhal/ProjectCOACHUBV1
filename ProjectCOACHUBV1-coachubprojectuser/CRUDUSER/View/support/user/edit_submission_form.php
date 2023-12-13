<?php
include '../../../Model/db_connection.php';
include '../../../Model/SubmissionHandler.php';

// Instanciez la classe SubmissionHandler
$submissionHandler = new SubmissionHandler($conn);

// Utilisez la fonction getSubmissionId pour récupérer les données de soumission
$row = $submissionHandler->getSubmissionId();

if ($row) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Submission</title>
    </head>
    <body>
        <h1>Edit Submission</h1>
        
        <form action="update_submission.php" method="post">
            <!-- Utilisez un champ caché pour stocker l'ID de soumission -->
            <input type="hidden" name="submission_id" value="<?php echo $row['submission_id']; ?>">
            
            <label for="name">Updated Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>

            <label for="contact">Updated Email or Phone:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>

            <label for="problem">Updated Problem Description:</label>
            <textarea id="problem" name="problem" rows="4" required><?php echo $row['problem_description']; ?></textarea>

            <button type="submit">Update</button>
        </form>
    </body>
    </html>
    <?php
} else {
    echo "La soumission avec l'ID n'a pas été trouvée dans la base de données.";
}

// Fermez la connexion à la base de données
$conn = null;
?>
