<?php
include '../../Model/user.class.php';
include '../../Model/config.php';

// Obtenir la connexion à la base de données
$conn = getConnexion();

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vous devez obtenir les données actuelles de l'utilisateur ici, par exemple en utilisant une méthode comme getById()
    $userInstance = new user($id, null, null, null, null, null, null, null, null, null, $conn);
    $userData = $userInstance->getbyid(); // Remplacez cela par la méthode appropriée pour obtenir les données

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mettre à jour toutes les données de l'utilisateur ici
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $ddn = $_POST['ddn'];
        $pays = $_POST['pays'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $cmdp = $_POST['cmdp'];
        $sexe = $_POST['sexe'];
        $type = $_POST['type'];

        // Appeler la méthode pour mettre à jour l'utilisateur
        $result = $userInstance->updateUser($nom, $prenom, $ddn, $pays, $email, $mdp, $cmdp, $sexe, $type);

        if ($result) {
            echo "Utilisateur mis à jour avec succès.";
            header('Location: Admin Dashboard.php');
            exit;
        } else {
            echo "Erreur lors de la mise à jour de l'utilisateur.";
        }
    }
}
    // Afficher le formulaire avec les données actuelles
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un Utilisateur</title>
    </head>
    <body>
        <h1>Modifier un Utilisateur</h1>
        <form method="POST">
    <!-- Ajoutez les autres champs du formulaire avec les valeurs existantes -->
    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="<?php echo $userData['nom']; ?>"><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value="<?php echo $userData['prenom']; ?>"><br>

    <label for="ddn">Date de naissance :</label>
    <input type="text" name="ddn" value="<?php echo $userData['ddn']; ?>"><br>

    <label for="pays">Pays :</label>
    <input type="text" name="pays" value="<?php echo $userData['pays']; ?>"><br>

    <label for="email">Email :</label>
    <input type="text" name="email" value="<?php echo $userData['email']; ?>"><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" value="<?php echo $userData['mdp']; ?>"><br>

    <label for="cmdp">Confirmer le mot de passe :</label>
    <input type="password" name="cmdp" value="<?php echo $userData['cmdp']; ?>"><br>

    <label for="sexe">Sexe :</label>
    <input type="text" name="sexe" value="<?php echo $userData['sexe']; ?>"><br>

    <label for="type">Type :</label>
    <input type="text" name="type" value="<?php echo $userData['type']; ?>"><br>

    <input type="submit" value="Mettre à jour">
</form>

    </body>
    </html>
