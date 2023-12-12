<?php
 include '../../../Model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];

    try {
        $stmt = $conn->prepare("DELETE FROM usersubmissions WHERE submission_id = :submission_id");

        $stmt->bindParam(':submission_id', $submission_id);

        $stmt->execute();

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
