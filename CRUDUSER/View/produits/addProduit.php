<?php
include '../../Model/ProduitP.php';
include '../../Model/config.php';
include '../../Model/Produit.php';

$error = "";

// create produit
$produit = null;

// create an instance of the controller
$produitC = new ProduitC();
if (
    isset($_POST["Description"]) &&
    isset($_POST["Quantite"]) &&
    isset($_POST["Prix"])
) {
    if (
        !empty($_POST['Description']) &&
        !empty($_POST["Quantite"]) &&
        !empty($_POST["Prix"])
    ) { //methode post pour recuperer les donneesapres envoi d'un form html 
        $produit = new Produit(
            null,
            $_POST['Description'],
            $_POST['Quantite'],
            $_POST['Prix']
        );

        // Check if a file was uploaded
        if (isset($_FILES['NouvelleImage'])) {
            // Get the file name
            $nomImage = $_FILES['NouvelleImage']['name'];

            // Move the uploaded file to a permanent location (adjust the path accordingly)
            $uploadDir = 'C:/xampp/htdocs/gestion_produits/view/image_bdd/';
            $nouveau_nom_img = $uploadDir . $nomImage;
            move_uploaded_file($_FILES['NouvelleImage']['tmp_name'], $nouveau_nom_img);
        } else {
            // Handle the case where no file was uploaded
            $nouveau_nom_img = ''; // or set it to a default value
        }

        $produitC->addProduit($produit, $nouveau_nom_img);

    
        // Use $imageUrl wherever you want to display the image

        header('Location:listProduit.php');
    } else {
        $error = "Missing information";
    }
}
?>

<!-- Ne mettez pas de code HTML après la balise PHP fermante -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Produit</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>

</head>
<body>
    <a href="listProduit.php">Retour à la liste</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
        <table border="1" align="center">
            <tr>
                <td>
                    <label for="Description">Description:
                    </label>
                </td>
                <td><input type="text" name="Description" id="Description" maxlength="255"></td>
            </tr>
            <tr>
                <td>
                    <label for="Quantite">Quantité:
                    </label>
                </td>
                <td><input type="text" name="Quantite" id="Quantite" maxlength="50"></td>
            </tr>
            <tr>
                <td>
                    <label for="Prix">Prix:
                    </label>
                </td>
                <td><input type="text" name="Prix" id="Prix"></td>
            </tr>
            <!-- Ajouter le champ de fichier pour l'image -->
            <tr>
                <td>
                    <label for="Image">Image:
                    </label>
                </td>
                <td><input type="file" name="NouvelleImage" id="NouvelleImage"></td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" value="Save">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
