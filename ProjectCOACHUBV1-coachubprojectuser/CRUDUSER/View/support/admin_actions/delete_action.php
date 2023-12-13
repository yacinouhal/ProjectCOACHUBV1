<?php
 include '../../../Model/db_connection.php';

if (isset($_GET['action_id'])) {
    $actionId = $_GET['action_id'];


    try {
        $sql = "DELETE FROM adminactions WHERE action_id = :action_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':action_id', $actionId, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin_actions.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    echo "Invalid request.";
}
?>
