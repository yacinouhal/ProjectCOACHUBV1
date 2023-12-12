<?php
include '../../Model/db_connection.php';
include '../../Model/ProduitP.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commander'])) {
    // Récupérez les données du produit sélectionné
    $produitC = new ProduitC();
    $selectedProductId = $_POST['IdProd'];
    $selectedProduct = $produitC->getProduitById($selectedProductId);

    // Stockez les données dans la session pour une utilisation ultérieure
    $_SESSION['selectedProduct'] = $selectedProduct;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <title>Coachub Delivery</title>
</head>
<body>
    <div class="container">
        <h2>Confirmation de la commande</h2>

        <?php if (isset($_SESSION['selectedProduct'])) { ?>
            <form id="orderConfirmationForm" action="insert_order.php" method="post">
                <label for="quantity">Quantité:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>

                <!-- Vous pouvez afficher d'autres détails du produit ici -->
                <p>Détails du produit:</p>
                <p>ID du produit: <?= $_SESSION['selectedProduct']['IdProd']; ?></p>
                <p>Description: <?= $_SESSION['selectedProduct']['Description']; ?></p>
                <p>Prix: <?= $_SESSION['selectedProduct']['Prix']; ?></p>

                <!-- Nouveaux champs ajoutés -->
                <label for="deliveryAddress">Delivery Address:</label>
                <textarea id="deliveryAddress" name="deliveryAddress" rows="4" required></textarea>

                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="+216 90-493-037" required>

                <label for="deliveryDate">Preferred Delivery Date:</label>
            <input type="date" id="deliveryDate" name="deliveryDate" required>

            <label for="deliveryTime">Estimated Delivery Time:</label>
            <input type="text" id="deliveryTime" name="deliveryTime" readonly>

                <input type="submit" value="Commander">
            </form>
        <?php } else { ?>
            <p>Aucun produit sélectionné.</p>
        <?php } ?>
    </div>
</body>
</html>
