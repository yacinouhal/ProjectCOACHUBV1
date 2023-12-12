<?php

include '../../Model/ProduitP.php';

$error = "";

// create produit
$produit = null;

// create an instance of the controller
$produitC = new ProduitC();

if (
    isset($_POST["IdProd"]) &&
    isset($_POST["Description"]) &&
    isset($_POST["Quantite"]) &&
    isset($_POST["Prix"])
) {
    if (
        !empty($_POST["IdProd"]) &&
        !empty($_POST['Description']) &&
        !empty($_POST["Quantite"]) &&
        !empty($_POST["Prix"])
    ) {
        $produit = new Produit(
            $_POST['IdProd'],
            $_POST['Description'],
            $_POST['Quantite'],
            $_POST['Prix']
        );
        $produitC->updateProduit($produit, $_POST["IdProd"]);
        header('Location:listProduit.php');
    } else
        $error = "Missing information";
}

?>

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit Display</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>


</head>
<body>
    <button><a href="listProduit.php">Back to list</a></button>
    <hr>
    <div id="error">
    <?php echo $error; ?>
</div>

<?php
if (isset($_POST['IdProd'])) {
    $produit = $produitC->showProduit($_POST['IdProd']);
?>

<form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
    <table border="1" align="center">
        <!-- Existing fields (IdProd, Description, Quantite, Prix) -->
        <tr>
            <td>
                <label for="IdProd">Id Produit:</label>
            </td>
            <td><input type="text" name="IdProd" id="IdProd" value="<?php echo $produit['IdProd']; ?>" maxlength="20" readonly></td>
        </tr>
        <tr>
            <td>
                <label for="Description">Description:</label>
            </td>
            <td><input type="text" name="Description" id="Description" value="<?php echo $produit['Description']; ?>" maxlength="255"></td>
        </tr>
        <tr>
            <td>
                <label for="Quantite">Quantité:</label>
            </td>
            <td><input type="text" name="Quantite" id="Quantite" value="<?php echo $produit['Quantite']; ?>" maxlength="50"></td>
        </tr>
        <tr>
            <td>
                <label for="Prix">Prix:</label>
            </td>
            <td><input type="text" name="Prix" id="Prix" value="<?php echo $produit['Prix']; ?>"></td>
        </tr>

        <!-- New row for updating the image -->
        <tr>
            <td>
                <label for="NouvelleImage">Nouvelle Image:</label>
            </td>
            <td>
                <input type="file" name="NouvelleImage" id="NouvelleImage">
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Modifier">
            </td>
        </tr>
    </table>
</form>
<?php } ?> 
</body>
</html>
