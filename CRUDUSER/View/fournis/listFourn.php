<?php
include '../../Controller/FournisseurF.php';
$FournisseurF = new FournisseurF(); // Assuming you have a controller for "fournisseurs" named FournisseurF.php
$list = $FournisseurF->listFournisseurs();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylev.css">
</head>
<body>
    <center>
        <h1>Liste Des Fournisseurs</h1>
        <h2>
            <a href="addFourn.php">Ajouter un Fournisseur</a> <!-- Assuming you have a form for adding fournisseurs named addFournisseur.php -->
        </h2>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id Fournisseur</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Id Prod</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($list as $fournisseur) {
        ?>
            <tr>
                <td><?= isset($fournisseur['id']) ? $fournisseur['id'] : ''; ?></td>
                <td><?= isset($fournisseur['nom']) ? $fournisseur['nom'] : ''; ?></td>
                <td><?= isset($fournisseur['adresse']) ? $fournisseur['adresse'] : ''; ?></td>
                <td><?= isset($fournisseur['idProd2']) ? $fournisseur['idProd2'] : ''; ?></td>
                <td align="center">
                    <form method="POST" action="updateFourn.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value="<?php echo isset($fournisseur['id']) ? $fournisseur['id'] : ''; ?>" name="id">
                    </form>
                </td>
                <td>
                    <a href="deleteFourn.php?id=<?php echo isset($fournisseur['id']) ? $fournisseur['id'] : ''; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
