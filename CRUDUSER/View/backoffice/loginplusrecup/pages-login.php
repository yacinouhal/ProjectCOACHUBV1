<?php
session_start();
include '../../../Model/config.php';

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
            header('Location: ../home/home.php'); // Rediriger vers le tableau de bord client
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- css link -->
    <link rel="stylesheet" href="../css/Login.css" />
    <!-- bootstrap link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="login">
      <img class="logo-coachub" src="../assets/img/coachubblanc.svg" alt="" />
      <form class="login-form" method="POST" action="">
        <input
          type="email"
          placeholder="your Email  'example@gmail.com'"
          name="email"
          class="input"
        />
        <p class="email-failed"></p>
        <input type="password" name="password" placeholder="your Password " class="input" />
        <p class="password-failed"></p>

        <button type="submit" class="login-button">LOGIN</button>
        <a href="forgot-password.php" class="Forget-password">Forget Password</a>
        <hr class="ligne" />
        <div class="socialmedia">
          <img class="email-login" src="../assets/img/google-svgrepo-com.svg" alt="" />
          <img class="github-login" src="../assets/img/github-svgrepo-com.svg" alt="" />
          <img class="linkedin-login" src="../assets/img/linkedin-svgrepo-com.svg" alt="" />
        </div>
      </form>
    </div>
  </body>
</html>

