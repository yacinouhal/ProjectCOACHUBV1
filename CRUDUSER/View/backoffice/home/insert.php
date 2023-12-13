<?php
 include '../../../Model/db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $problem = $_POST['problem'];


    try {
        $stmt = $conn->prepare("INSERT INTO usersubmissions (name, contact, problem_description) VALUES (:name, :contact, :problem)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':problem', $problem);

        $stmt->execute();

        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>