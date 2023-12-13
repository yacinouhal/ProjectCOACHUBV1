<?php
// update_order.php
include '../../Model/db_connection.php';
include '../../Controller/OrderManager.php';
$orderManager = new OrderManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Print the content of the $_POST array for debugging
    echo "POST Data: ";
    print_r($_POST);

    // Check if 'order_id' is set in the $_POST array
    if (isset($_POST['order_id'])) {
        // Get data from the form
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        try {
            // Update order status
            $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE order_id = :order_id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();

            echo "Order updated successfully!";
        } catch (PDOException $e) {
            echo "Error updating order: " . $e->getMessage();
        }
    } else {
        echo "Error: 'order_id' is not set in the POST data.";
    }
} else {
    // Display the form for updating the order
    $order_id = $_GET['order_id'];
    echo "<form method='post' action='update_order.php'>";
    echo "New Status: <input type='text' name='status' required>";
    echo "<input type='hidden' name='order_id' value='$order_id'>";
    echo "<input type='submit' value='Update Order'>";
    echo "</form>";
}
?>

