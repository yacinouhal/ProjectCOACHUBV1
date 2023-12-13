<?php
include '../../Model/user.class.php';
include '../../Model/config.php';

// Obtenir la connexion à la base de données
$conn = getConnexion();

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué.");
}

// Créer une instance de la classe user en passant la connexion en paramètre
$userInstance = new user(null, null, null, null, null, null, null, null, null, null);

// Supprimer un utilisateur si l'ID est présent dans la requête GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userInstance->deleteUser($id);

    // Rediriger vers la page après la suppression
    header('Location: listesuser.php');
    exit;
}


// Récupérer la liste des utilisateurs
$users = $userInstance->listesUser();

echo '<table border="1">';
echo '<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Date de Naissance</th><th>Pays</th><th> Adresse</th><th>Numéro de télephone</th><th>Email</th><th>Mot de passe </th><th> Confirmer Mot passe <th>sex</th><th>type</th><th>ACTIONS</th><th>ACTIONS</th></tr>';

foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user['id'] . '</td>';
    echo '<td>' . $user['nom'] . '</td>';
    echo '<td>' . $user['prenom'] . '</td>';
    echo '<td>' . $user['ddn'] . '</td>';
    echo '<td>' . $user['pays'] . '</td>';
    echo '<td>' . $user['email'] . '</td>';
    echo '<td>' . $user['mdp'] . '</td>';
    echo '<td>' . $user['cmdp'] . '</td>';
    echo '<td>' . $user['sexe'] . '</td>';
    echo '<td>' . $user['type'] . '</td>';
    echo '<td><a href="listesuser.php?id=' . $user['id'] . '">DELETE</a></td>';
    echo '<td><a href="updateuser.php?id=' . $user['id'] . '">UPDATE</a></td>';
    echo '</tr>';
}

echo '</table>';
echo '<a href="../frontoffice/adduser.php">ADD user</a>';
?>
