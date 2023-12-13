<?php
include '../../Model/ProduitP.php';

$produitC = new ProduitC();
$list = $produitC->listProduits();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylev.css">
    <title>Liste Des Produits</title>
</head>
<body>
    <h1>Liste Des Produits</h1>
    <h2><a href="addProduit.php">Ajouter un produit</a></h2>

    <?php if (!empty($list)) { ?>
        <table align="center" width="70%">
    <tr>
        <th>Id Produit</th>
        <th>Description</th>
        <th>Quantité</th>
        <th>Prix</th>
        <th>Image</th>
        <th>Update</th>
        <th>Delete</th>
        <th>Nouvelle Quantité</th> <!-- Nouvelle colonne pour afficher la nouvelle quantité -->
    </tr>
    <?php foreach ($list as $produit) { ?>
        <tr>
            <td><?= $produit['IdProd']; ?></td>
            <td><?= $produit['Description']; ?></td>
            <td><?= $produit['Quantite']; ?></td>
            <td><?= $produit['Prix']; ?></td>
            
            <!-- Display the image if available -->
            <td align="center">
                <?php
                $nomImage = $produitC->getImageByIdProduit($produit['IdProd']);
                $myArray = explode('/', $nomImage);
                $name = $myArray[sizeof($myArray)-1];
                if (!empty($nomImage)) {
                    $cheminImage = "http://localhost/gestion_produits/view/image_bdd/" . $name;
                    ?>
                    <img src="<?php echo $cheminImage; ?>" alt="Image du produit" style="width: 50px; height: 50px;">
                    <?php
                } else {
                    echo "Aucune image disponible";
                }
                ?>
            </td>
            <td align="center">
                <form method="POST" action="updateProduit.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $produit['IdProd']; ?>" name="IdProd">
                </form>
            </td>
            <td>
                <a href="deleteProduit.php?IdProd=<?= $produit['IdProd']; ?>">Delete</a>
            </td>
            <td><?= $produit['NouvelleQuantite']; ?></td> <!-- Affichage de la nouvelle quantité -->
        </tr>
    <?php } ?>
</table>
    <?php } else { ?>
        <p>Aucun produit trouvé.</p>
    <?php } ?>
</body>
</html>
