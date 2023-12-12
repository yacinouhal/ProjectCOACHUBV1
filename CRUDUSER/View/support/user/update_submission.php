<?php
include '../../../Model/db_connection.php';
include '../../../Model/SubmissionHandler.php';

// Instanciez la classe SubmissionHandler
$submissionHandler = new SubmissionHandler($conn);

// Utilisez la fonction getSubmissionId pour récupérer les données de soumission
$row = $submissionHandler->getSubmissionId();

if ($row) {
    try {
        // Récupérer les données du formulaire
        $submissionId = $_POST['submission_id'];
        $updatedName = $_POST['name'];
        $updatedContact = $_POST['contact'];
        $updatedProblem = $_POST['problem'];

        // Requête SQL pour la mise à jour
        $sql = "UPDATE usersubmissions SET name = :name, contact = :contact, problem_description = :problem WHERE submission_id = :id";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liens des paramètres
        $stmt->bindParam(':id', $submissionId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $updatedName, PDO::PARAM_STR);
        $stmt->bindParam(':contact', $updatedContact, PDO::PARAM_STR);
        $stmt->bindParam(':problem', $updatedProblem, PDO::PARAM_STR);

        // Exécuter la requête
        $stmt->execute();

        // Rediriger vers une page de succès
        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        // Journaliser l'erreur (utiliser un mécanisme de journalisation)
        error_log("Erreur lors de la mise à jour de l'enregistrement : " . $e->getMessage(), 0);
        // Rediriger l'utilisateur vers une page d'erreur
        header("Location: error.php");
        exit();
    } finally {
        // Fermer la connexion à la base de données
        $conn = null;
    }
} else {
    echo "La soumission avec l'ID n'a pas été trouvée dans la base de données.";
}
?>
