<?php
session_start(); // Ajout de session_start()

include '../../Model/ProduitP.php';

$produitC = new ProduitC();
$list = $produitC->listProduits();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commander'])) {
    $productId = $_POST['IdProd'];

    // Ajoutez le produit à la session
    if (!isset($_SESSION['commande'])) {
        $_SESSION['commande'] = array();
    }

    $_SESSION['commande'][] = $productId;

    // Redirigez l'utilisateur vers userorderindex.php
    header("Location: ../order/userorderindex.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez vos balises meta, title, stylesheets, etc. ici -->
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
                <th>Commander</th>
            </tr>
            <?php foreach ($list as $produit) { ?>
                <tr>
                    <td><?= $produit['IdProd']; ?></td>
                    <td><?= $produit['Description']; ?></td>
                    <td><?= $produit['Quantite']; ?></td>
                    <td><?= $produit['Prix']; ?></td>
                    
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
                        <form method="POST" action="../order/userorderindex.php">
                            <input type="submit" name="commander" value="Commander">
                            <input type="hidden" value="<?= $produit['IdProd']; ?>" name="IdProd">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Aucun produit trouvé.</p>
    <?php } ?>
</body>
</html>
