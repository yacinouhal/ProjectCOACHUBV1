<?php
include '../../Model/db_connection.php';
include '../../Controller/OrderManager.php';

$orderManager = new OrderManager($conn);

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    if ($orderManager->deleteOrder($orderId)) {
        echo "Order deleted successfully!";
    } else {
        echo "Error: Unable to delete order.";
    }
} else {
    echo "Error: Order ID not provided.";
}
?>
