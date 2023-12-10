<?php
session_start();
include '../../Model/config.php';

// Utilisez la fonction pour obtenir la connexion
$conn = getConnexion();

// Vérifiez la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier les informations d'authentification pour les admins
    $adminQuery = "SELECT * FROM admins WHERE email = :email AND password = :password";
    $adminStmt = $conn->prepare($adminQuery);

    // Liens des paramètres
    $adminStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $adminStmt->bindParam(':password', $password, PDO::PARAM_STR);

    // Exécutez la requête
    $adminStmt->execute();

    // Récupérer le résultat pour les admins
    $adminResult = $adminStmt->fetch(PDO::FETCH_ASSOC);

    // Requête SQL pour vérifier les informations d'authentification pour les users
    $userQuery = "SELECT * FROM users WHERE email = :email AND mdp = :password";
    $userStmt = $conn->prepare($userQuery);

    // Liens des paramètres
    $userStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $userStmt->bindParam(':password', $password, PDO::PARAM_STR);

    // Exécutez la requête
    $userStmt->execute();

    // Récupérer le résultat pour les users
    $userResult = $userStmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur est un admin
    if ($adminResult) {
        // Informations correctes pour un admin, rediriger vers le tableau de bord admin
        $_SESSION['admin'] = true;
        header('Location: Admin Dashboard.php');
        exit;
    } elseif ($userResult) {
        $_SESSION['user'] = true;
        $_SESSION['user_id'] = $userResult['id']; // Stocker l'ID de l'utilisateur dans la session

        if ($userResult['type'] == 'client') {
            header('Location: Client Dashboard.php'); // Rediriger vers le tableau de bord client
        } elseif ($userResult['type'] == 'professionnel') {
            header('Location: error-404.html'); // Rediriger vers le tableau de bord professionnel
        } else {
            // Type d'utilisateur non reconnu, rediriger vers une page d'erreur
            header('Location: error-404.html');
        }
        exit;
    } else {
        // Identifiants incorrects, rediriger vers la page d'erreur
        header('Location: error-404.html');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Ajoutez ici vos liens vers les feuilles de style, scripts, etc. -->
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    
    <p><a href="forgot-password.php">Mot de passe oublié ?</a></p>
    
    <!-- Ajoutez ici d'autres éléments de votre page, comme des liens vers la récupération de mot de passe, etc. -->
</body>
</html>
