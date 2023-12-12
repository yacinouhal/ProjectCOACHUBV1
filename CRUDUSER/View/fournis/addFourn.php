<?php
include '../../Model/config.php';
include '../../Controller/FournisseurF.php';

$error = "";
$FournisseurF = null;

// create an instance of the controller
$FournisseurF = new FournisseurF();
// creation de l'objet fournisseur
if (
    isset($_POST["nom"]) &&
    isset($_POST["adresse"]) &&
    isset($_POST["idProd2"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["adresse"]) &&
        !empty($_POST["idProd2"])
    ) {
        $Fournisseur = new Fournisseur(
            null,
            $_POST['nom'],      // Assuming "Somme" corresponds to "nom"
            $_POST['adresse'],  // Assuming "IdProd" corresponds to "adresse"
            $_POST['idProd2']   // Assuming "idProd2" is provided in the form
        );
        $FournisseurF->addFournisseur($Fournisseur);
        header('Location:listFourn.php'); // You might want to update the redirection URL
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Produit</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scriptfourn.js"></script>

</head>
<body>
    <a href="listFourn.php">Retour à la liste</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm2();" novalidate>
        <table border="1" align="center">
            <tr>
                <td>
                    <label for="nom">Nom:
                    </label>
                </td>
                <td><input type="text" name="nom" id="nom" maxlength="255"></td>
            </tr>
            <tr>
                <td>
                    <label for="adresse">Adresse:
                    </label>
                </td>
                <td><input type="text" name="adresse" id="adresse" maxlength="255"></td>
            </tr>
            <tr>
                <td>
                    <label for="idProd2">IdProd2:
                    </label>
                </td>
                <td><input type="text" name="idProd2" id="idProd2" maxlength="50"></td>
            </tr>
            <tr align="center">
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
