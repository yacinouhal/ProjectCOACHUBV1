<?php
include '../../Model/db_connection.php';
include '../../Controller/OrderManager.php';

$orderManager = new OrderManager($conn);
$ordersPerPage = 2;

// Check for search
$searchOrderId = isset($_GET['search']) ? intval($_GET['search']) : null;
if ($searchOrderId !== null) {
    $order = $orderManager->getOrderById($searchOrderId);
    if ($order === null) {
        echo "<script>alert('Order ID not found.');</script>";
        echo "<script>window.location.href = 'adminorderindex.php';</script>";
        exit;
    } else {
        $orders = [$order];
    }
} else {
    // Retrieve all orders
    $orders = $orderManager->getAllOrders();
}

$totalOrders = count($orders);
$totalPages = ceil($totalOrders / $ordersPerPage);

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $ordersPerPage;

$paginatedOrders = array_slice($orders, $offset, $ordersPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
</head>
<body>
    <!-- Your body content here -->

    <div class="search-container">
        <form action="adminorderindex.php" method="get">
            <input type="text" name="search" class="search-input" placeholder="Search by Order ID">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="admin-container">
        <?php
        foreach ($paginatedOrders as $order) {
            echo "<div class='container'>";
            echo "<h2>Order #{$order['order_id']}</h2>";
            echo "<p><strong>User ID:</strong> {$order['user_id']}</p>";
            echo "<p><strong>Order Date:</strong> {$order['order_date']}</p>";
            echo "<p><strong>Total Price:</strong> {$order['total_price']}</p>";
            echo "<p><strong>Status:</strong> {$order['status']}</p>";
            echo "<p><strong>Delivery Address:</strong> {$order['delivery_address']}</p>";
            echo "<p><strong>Phone Number:</strong> {$order['phone_number']}</p>";
            echo "<p class='actions'>";
            echo "<a href='update_order.php?order_id={$order['order_id']}'>Update</a> | ";
            echo "<a href='delete_order.php?order_id={$order['order_id']}'>Delete</a>";
            echo "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='adminorderindex.php?page={$i}'>{$i}</a> ";
        }
        ?>
    </div>

    <?php
    if (isset($searchOrderId) && $order === null) {
        echo "<button class='return-button' onclick='goBack()'>Return</button>";
    }
    ?>

    <!-- Your script tags here -->
</body>
</html>
