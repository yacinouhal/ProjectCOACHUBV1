<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header('Location: pages-login.php');
    exit;
}

include '../../Model/config.php';  // Assurez-vous d'inclure le fichier de configuration pour obtenir la connexion

$conn = getConnexion();

if (!$conn) {
    die("La connexion à la base de données a échoué.");
}

$userId = $_SESSION['user_id']; // Supposons que vous stockez l'ID de l'utilisateur dans la session

// Effectuez une requête SQL pour obtenir les informations de l'utilisateur à partir de la base de données
$query = "SELECT * FROM users WHERE id = :userId";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord utilisateur</title>
</head>
<body>
    <h1>Tableau de bord utilisateur</h1>

    <!-- Affichez les informations de l'utilisateur dans un tableau -->
    <table >
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Pays</th>
            <th>email</th>
            <th>mdp</th>
            <th>cmdp</th>
            <th>sexe</th>
            <th>typ</th>

        </tr>
        <tr>
            <td><?php echo $userData['id']; ?></td>
            <td><?php echo $userData['nom']; ?></td>
            <td><?php echo $userData['prenom']; ?></td>
            <td><?php echo $userData['ddn']; ?></td>
            <td><?php echo $userData['pays']; ?></td>
            <td><?php echo $userData['email']; ?></td>
            <td><?php echo $userData['mdp']; ?></td>
            <td><?php echo $userData['cmdp']; ?></td>
            <td><?php echo $userData['sexe']; ?></td>
            <td><?php echo $userData['type']; ?></td>
        </tr>
    </table>

    <!-- Vous pouvez ajouter d'autres éléments HTML, des liens, des boutons, etc. -->

</body>
</html>
