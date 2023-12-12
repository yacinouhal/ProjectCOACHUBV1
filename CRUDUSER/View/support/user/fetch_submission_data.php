<?php
include '../../../Model/db_connection.php';

// Vérifiez si la clé 'submission_id' est définie dans $_POST
if (isset($_POST['submission_id'])) {
    // La clé 'submission_id' existe dans $_POST, vous pouvez l'utiliser
    $submissionId = $_POST['submission_id']; 

    // Fetch data from the database based on submission_id
    $stmt = $conn->prepare("SELECT * FROM usersubmissions WHERE submission_id = :submission_id");
    $stmt->bindParam(':submission_id', $submissionId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the data only if it exists
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && isset($row['submission_id'])) {
        // La clé 'submission_id' est définie dans $row
        // Reste du code...
    } else {
        // Gérer le cas où la clé 'submission_id' n'est pas définie
        echo "La soumission avec l'ID $submissionId n'a pas été trouvée dans la base de données.";
    }
    
    // Close the database connection
    $conn = null;
} else {
    // Gérer le cas où la clé 'submission_id' n'est pas définie dans $_POST
    echo "La clé 'submission_id' n'est pas définie dans le tableau \$_POST.";
}
?>


