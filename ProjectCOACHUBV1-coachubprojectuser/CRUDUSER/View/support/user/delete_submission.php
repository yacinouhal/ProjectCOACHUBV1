<?php
 include '../../../Model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $submissionId = $_GET['id'];

        $sql = "DELETE FROM usersubmissions WHERE submission_id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $submissionId);

        $stmt->execute();

        echo "Submission deleted successfully.";
        header("Location: http://localhost/support/");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    echo "Invalid request method.";
}
?>
