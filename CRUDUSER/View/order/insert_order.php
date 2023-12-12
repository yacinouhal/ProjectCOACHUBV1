<?php
include '../../Model/db_connection.php';
include '../../Model/ProduitP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deliveryAddress = isset($_POST['deliveryAddress']) ? $_POST['deliveryAddress'] : '';
    $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
    $deliveryDate = isset($_POST['deliveryDate']) ? $_POST['deliveryDate'] : '';
    $specialInstructions = isset($_POST['specialInstructions']) ? $_POST['specialInstructions'] : '';

    try {
        $stmt = $conn->prepare("INSERT INTO orders (delivery_address, phone_number, preferred_delivery_datetime, special_instructions) VALUES (?, ?, ?, ?)");
        $stmt->execute([$deliveryAddress, $phoneNumber, $deliveryDate, $specialInstructions]);

        $lastOrderId = $conn->lastInsertId();

        $selectedProducts = isset($_POST['selectedProducts']) ? $_POST['selectedProducts'] : array();

        if (!empty($selectedProducts)) {
            foreach ($_POST['selectedProducts'] as $productId) {
                // Retrieve product details from the listProduit.php file
                $product = $produitC->getProduitById($productId);
            
                // Insert into 'order_items' table
                $quantity = $_POST['products'][$productId];
                $price = $product['Prix'];
                $totalPrice = $quantity * $price;
            
                // Insérer dans la table 'order_items'
                $stmtOrderItems = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
                $stmtOrderItems->execute([$lastOrderId, $productId, $quantity, $totalPrice]);
            
                // Mettre à jour la quantité du produit dans la table 'produits'
                $newQuantity = $product['Quantite'] - $quantity;
                $stmtDecrementQuantity = $conn->prepare("UPDATE produits SET Quantite = ? WHERE IdProd = ?");
                $stmtDecrementQuantity->execute([$newQuantity, $productId]);
            }
            
        }
        

        echo "Commande créée avec succès";
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>
