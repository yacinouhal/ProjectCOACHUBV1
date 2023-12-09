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
    // Récupérer l'e-mail du formulaire
    $email = $_POST['email'];

    // Requête SQL pour vérifier si l'e-mail existe dans la base de données
    $userQuery = "SELECT * FROM users WHERE email = :email";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $userStmt->execute();
    $userResult = $userStmt->fetch(PDO::FETCH_ASSOC);

    if ($userResult) {
        // Générer un jeton unique pour la réinitialisation du mot de passe
        $token = bin2hex(random_bytes(32));

        // Stocker le jeton dans la base de données avec l'e-mail de l'utilisateur
        $updateTokenQuery = "UPDATE users SET reset_token = :token WHERE email = :email";
        $updateTokenStmt = $conn->prepare($updateTokenQuery);
        $updateTokenStmt->bindParam(':token', $token, PDO::PARAM_STR);
        $updateTokenStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $updateTokenStmt->execute();

        // Envoyer un e-mail avec un lien vers la page de réinitialisation du mot de passe
        $resetLink = "http://votredomaine.com/reset-password.php?email=$email&token=$token";

        // Contenu de l'e-mail
        $subject = "Réinitialisation du mot de passe";
        $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetLink";

        // En-têtes de l'e-mail
        $headers = "From: yassine.romdh@gmail.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "E-mail envoyé avec succès";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail";
        }

        // Rediriger l'utilisateur vers une page de confirmation
        header('Location: password-reset-sent.php');
        exit;
    } else {
        // E-mail non trouvé dans la base de données
        $error = "E-mail non trouvé. Veuillez vérifier votre adresse e-mail.";
    }
}
?>
