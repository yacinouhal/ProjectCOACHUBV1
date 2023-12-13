<?php
include '../../Model/ProduitP.php';

// Check if "IdProd" is set in the $_GET array
if (isset($_GET["IdProd"])) {
    $articleC = new ProduitC();
    $articleC->deleteProduit($_GET["IdProd"]);
} else {
    echo "IdProd is not set";
}

// Redirect to the listProduit.php page
header('Location: listProduit.php');
exit(); // Ensure that no further code is executed after the redirection
?>
