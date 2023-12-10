<?php
session_start();
include '../../Model/config.php';
include '../../Model/user.class.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Validez les données avant de les utiliser
    if (empty($newPassword) || empty($confirmPassword)) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    // Assurez-vous que les mots de passe correspondent
    if ($newPassword !== $confirmPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Obtenez l'e-mail à partir de la session
    $email = isset($_SESSION['reset_email']) ? $_SESSION['reset_email'] : '';

    // Ajoutez cet écho pour le débogage
    echo "Email récupéré de la session: $email";

    if (empty($email)) {
        echo "L'e-mail n'est pas défini.";
        exit;
    }

    // Créer une instance de la classe User avec l'e-mail
    $user = new User(null, null, null, null, null, $email, null, null, null, null);
    // Dans reset-password.php
    $resetToken = isset($_GET['token']) ? $_GET['token'] : '';
    echo "Reset Token (URL): $resetToken";

    if ($user->isResetTokenValid($resetToken)) {
        // Le jeton est valide, permettre la réinitialisation du mot de passe

        // Ajoutez cet écho pour le débogage
        echo "Le jeton est valide.";

        // Hasher le nouveau mot de passe avant de le stocker dans la base de données
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $user->updatePassword($hashedPassword, $confirmPassword);

        // Supprimer le jeton de réinitialisation
        $user->clearResetToken();

        // Rediriger vers une page de confirmation ou de connexion
        header('Location: reset-password-confirm.php');
        exit;
    } else {
        // Le jeton a expiré, affichez un message d'erreur approprié
        echo "Le lien de réinitialisation du mot de passe est invalide ou a expiré.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <!-- Formulaire pour saisir le nouveau mot de passe et le confirmer -->
    <form method="post" action="">
        <input type="hidden" name="reset_token" value="<?php echo isset($_GET['reset_token']) ? htmlspecialchars($_GET['reset_token']) : ''; ?>">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
