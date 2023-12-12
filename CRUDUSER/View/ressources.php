<?php 
include '../Controller/ProduitP.php';
    $error = "";

    $produitc = new ProduitC();
    
    if (isset($_POST["send"])) {
        if (!empty($_FILES["image"]) && isset($_POST["id_prod"]) && $_POST["id_prod"] != "") {
            // Laisser le nom de l'image tel quel, on le modifie dans le contrôleur
            $produit = new Produit($_POST["id_prod"], null, null, null, $_FILES["image"]["name"]);
            $produitC->ajouterImageProduit($produit);
            // ...
        } else {
            $error = "Missing information";
        }
    }
?>    

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter une ressource</title>
    <link rel="stylesheet" type="text/css" href="style2.css">

</head>
<body>
    <h1>Ajouter une ressource</h1>
    <?php
        //affichage du message d'erreur s'il existe
        if(isset($message)){
            echo "<p style='color:red'>".$message."</p>";
        }
    ?>
    <a href="listeress.php" class="redirect-btn">Liste des ressources</a>

    <form method="POST" action="" enctype="multipart/form-data">
    <label for="image">Choisir une image :</label>
    <input type="file" name="image" id="image" required><br><br>

    <!-- Autres champs du produit -->

    <input type="submit" name="send" value="Ajouter l'image du produit">
</form>
</body>
</html>