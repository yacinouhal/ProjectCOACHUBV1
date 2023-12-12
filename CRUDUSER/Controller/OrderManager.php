<?php

class OrderManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllOrders()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM orders");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in OrderManager: " . $e->getMessage());
            return [];
        }
    }

    public function getOrderById($orderId)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM orders WHERE order_id = :order_id");
            $stmt->bindParam(':order_id', $orderId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in OrderManager: " . $e->getMessage());
            return null;
        }
    }

    public function deleteOrder($orderId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM orders WHERE order_id = :order_id");
            $stmt->bindParam(':order_id', $orderId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error in OrderManager: " . $e->getMessage());
            return false;
        }
    }

    public function updateOrderStatus($orderId, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE orders SET status = :status WHERE order_id = :order_id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $orderId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error in OrderManager: " . $e->getMessage());
            return false;
        }
    }
}

?>
