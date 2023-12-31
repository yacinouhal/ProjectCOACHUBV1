<?php
session_start();
include '../../../Model/config.php';
include '../../../Model/user.class.php';

require '../../../PHPMailer-master/src/Exception.php';
require '../../../PHPMailer-master/src/PHPMailer.php';
require '../../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Fonction pour générer un jeton unique
function generateResetToken() {
    return bin2hex(random_bytes(32));
}

// Fonction pour envoyer l'e-mail de réinitialisation de mot de passe
function sendResetEmail($userEmail, $resetToken) {

    echo "User Email: $userEmail<br>";
    echo "Reset Token: $resetToken<br>";
    // Construire le lien de réinitialisation
    $resetLink = "http://localhost/COACHHUB/CRUDUSER/View/backoffice/loginplusrecup/reset-password.php?token=$resetToken";

    // Configuration de PHPMailer
    $mail = new PHPMailer(true);
    try {
         //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'coachubcenter@gmail.com'; // Votre adresse e-mail Gmail
    $mail->Password   = 'ldxk vfzc dvxr hhyt'; // Utilisez le mot de passe d'application généré
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

        //Recipients
        $mail->setFrom('yassine.romdh@gmail.com', 'admin coahub'); // Remplacez par votre adresse e-mail et nom

        $mail->addAddress($userEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation de mot de passe';
        $mail->Body    = "Salut,<br><br>Ceci est un e-mail de récupération. Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href='$resetLink'>$resetLink</a>";

        $mail->send();
        echo "L'e-mail de réinitialisation a été envoyé avec succès.";
    } catch (Exception $e) {
        echo "Échec de l'envoi de l'e-mail de réinitialisation. Erreur : {$mail->ErrorInfo}";
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Validez les données avant de les utiliser
    if (empty($email)) {
        echo "Veuillez fournir une adresse e-mail.";
        exit;
    }

    // Assurez-vous que $conn est défini, par exemple, en l'initialisant avec votre connexion à la base de données
    $conn = getConnexion();
    if ($conn) {
        // Créer une instance de la classe User avec l'e-mail
        $user = new User(null, null, null, null, null, $email, null, null, null, null);

        // Vérifier si l'e-mail existe dans la base de données
        $userData = $user->getbyemail();
        if (!$userData) {
            echo "Cette adresse e-mail n'est pas enregistrée. Veuillez réessayer avec une autre adresse e-mail.";
            // Optionnel : Vous pouvez également fournir un lien de retour vers le formulaire
            echo '<br><a href="forgot-password.php">Retourner au formulaire de récupération</a>';
            exit;
        }

        // L'e-mail existe dans la base de données, continuez avec le processus de réinitialisation...
        
      // Dans la fonction generateResetToken()
      $resetToken = generateResetToken();
      echo "Generated Reset Token: $resetToken";

        // Enregistrez le jeton dans votre base de données
        $user->updateResetToken($resetToken, date('Y-m-d H:i:s', strtotime('+1 hour')));

       // Enregistrez l'e-mail dans la variable de session
            $_SESSION['reset_email'] = $email;

       // Envoie de l'e-mail de réinitialisation
            sendResetEmail($email, $resetToken);
            
        // Rediriger l'utilisateur vers une page de confirmation
        header('Location: sended.php');
        exit;
    
    } else {
        echo "La connexion à la base de données a échoué.";
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
    <link rel="stylesheet" href="../css/forgotpasswordView.css" />
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
      <form class="login-form" method="post" action="forgot-password.php">
        <input
          type="email"
          name="email"
          placeholder="your Email  'example@gmail.com'"
          class="input"
        />
        <p class="email-failed"></p>
        <button type="submit" name="resetPassword" class="Send-Button">Reset Password</button>

      </form>
    </div>
  </body>
</html>