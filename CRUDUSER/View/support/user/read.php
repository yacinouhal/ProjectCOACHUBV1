<?php
 include '../../../Model/db_connection.php';
try {
    $stmt = $conn->prepare("SELECT * FROM usersubmissions");
    $stmt->execute();
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
