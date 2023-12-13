<?php

include '../../Controller/FournisseurF.php'; // Assuming you have a controller for "fournisseurs" named FournisseurF.php

$error = "";
$fournisseur = null;

// create an instance of the controller
$fournisseurF = new FournisseurF();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id"]) &&   
        isset($_POST["nom"]) &&
        isset($_POST["adresse"]) &&
        isset($_POST["idProd2"])
    ) {
        if (
            !empty($_POST["id"]) &&
            !empty($_POST["nom"]) &&
            !empty($_POST["adresse"]) &&
            !empty($_POST["idProd2"])
        ) {
            $fournisseur = new Fournisseur(
                $_POST["id"],
                $_POST["nom"],
                $_POST["adresse"],
                $_POST["idProd2"]
            );
            $fournisseurF->updateFournisseur($fournisseur, $_POST["id"]);
            header('Location: listFourn.php'); // Assuming you have a list page for "fournisseurs"
            exit(); // Add this to terminate the script after the redirection
        } else {
            $error = "Missing information";
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fournisseurs Display</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scriptfourn.js"></script>

</head>
<body>
    <a href="listFourn.php">Back to list</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $fournisseur = $fournisseurF->showFournisseur($_POST['id']);
        ?>

<form action="updateFourn.php" method="POST" onsubmit="return validateForm2()">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <table border="1" align="center">
            <tr>
                    <td>
                        <label for="nom">Nom:</label>
                    </td>
                    <td><input type="text" name="nom" id="nom" value="<?php echo isset($fournisseur['nom']) ? $fournisseur['nom'] : ''; ?>" maxlength="255"></td>
                </tr>
                <tr>
                    <td>
                        <label for="adresse">Adresse:</label>
                    </td>
                    <td><input type="text" name="adresse" id="adresse" value="<?php echo isset($fournisseur['adresse']) ? $fournisseur['adresse'] : ''; ?>" maxlength="255"></td>
                </tr>
                <tr>
                    <td>
                        <label for="idProd2">Id Prod:</label>
                    </td>
                    <td><input type="text" name="idProd2" id="idProd2" value="<?php echo isset($fournisseur['idProd2']) ? $fournisseur['idProd2'] : ''; ?>" maxlength="50"></td>
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
