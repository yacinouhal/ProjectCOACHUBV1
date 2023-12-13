<!-- view_orders.php -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste des Commandes</title>
</head>
<body>
    <h2>Liste des Commandes</h2>
    <?php if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) { ?>
        <ul>
            <?php foreach ($_SESSION['orders'] as $order) { ?>
                <li><?= $order['Description']; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>Aucune commande pour le moment.</p>
    <?php } ?>
</body>
</html>
