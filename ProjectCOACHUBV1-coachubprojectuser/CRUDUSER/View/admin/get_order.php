<?php
include '../../Model/db_connection.php';
try {
    $stmt = $conn->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error in get_order.php: " . $e->getMessage());
    echo "An error occurred while fetching orders. Please try again later.";
}
?>
