<?php
include'../Model/user.class.php';
include'../Model/config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ddn = $_POST["ddn"];
    $pays = $_POST["pays"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $cmdp = $_POST["cmdp"];
    $sexe = $_POST["sexe"];
    $type = $_POST["type"];

    // Créer une instance de la classe User
    $user = new user(null,$nom, $prenom, $ddn, $pays, $email, $mdp, $cmdp, $sexe, $type);

    // Ajouter l'utilisateur à la base de données
    $conn = getConnexion();  // Assurez-vous que la fonction getConnexion() est correctement définie dans le fichier config.php
    $message = $user->addUser($conn); echo $message;
    // Appeler la fonction addUser pour ajouter l'utilisateur
    if ($user->addUser($conn)) {
      // L'ajout a réussi, afficher une alerte côté client
      echo '<script>alert("Utilisateur ajouté avec succès.");</script>';
  } else {
      // L'ajout a échoué, afficher une alerte d'erreur côté client
      echo '<script>alert("Erreur lors de l\'ajout de l\'utilisateur.");</script>';
  } // Fermer la connexion à labase de données 
    $conn = null; } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link
      rel="stylesheet"
      href="../frontoffice/fonts/material-icon/css/material-design-iconic-font.min.css"
    />

    <!-- Main css -->
    <link rel="stylesheet" href="../frontoffice/css/style.css" />
  </head>
  <body>
    <div class="main">
      <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container">
          <div class="signup-content">
            <form method="POST" id="signup-form" class="signup-form">
              <h2 class="form-title">Create account</h2>
              <div class="form-group">
                <input
                  type="text"
                  class="form-input"
                  name="nom"
                  id="name"
                  placeholder="Your LastName"
                />
              </div>

              <div class="form-group">
                <input
                  type="text"
                  class="form-input"
                  name="prenom"
                  id="prenom"
                  placeholder="Your FisrtName"
                />
              </div>
              <div class="form-group">
                <input
                  type="date"
                  class="form-input"
                  name="ddn"
                  id="ddn"
                  placeholder="Your Birth"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-input"
                  name="pays"
                  id="pays"
                  placeholder="Your country"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  class="form-input"
                  name="email"
                  id="email"
                  placeholder="Your Email"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-input"
                  name="mdp"
                  id="mdp"
                  placeholder="Password"
                />
                <span
                  toggle="#password"
                  class="zmdi zmdi-eye field-icon toggle-password"
                ></span>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  class="form-input"
                  name="cmdp"
                  id="cmdp"
                  placeholder="Repeat your password"
                />
              </div>

              <div class="form-group">
                <select class="form-input" name="sexe" required>
                  <option value="male">Homme</option>
                  <option value="female">Femme</option></select
                ><br />
              </div>

              <div class="form-group">
                <select class="form-input" name="type" required>
                  <option value="client">Client</option>
                  <option value="professionnel">Professionnel</option></select
                ><br />
              </div>
              <div class="form-group">
                <input
                  type="checkbox"
                  name="agree-term"
                  id="agree-term"
                  class="agree-term"
                />
                <label for="agree-term" class="label-agree-term"
                  ><span><span></span></span>I agree all statements in
                  <a href="#" class="term-service">Terms of service</a></label
                >
              </div>
              <div class="form-group">
                <input
                  type="submit"
                  name="submit"
                  id="submit"
                  class="form-submit"
                  value="Sign up"
                />
              </div>
            </form>
            <p class="loginhere">
              Have already an account ?
              <a href="#" class="loginhere-link">Login here</a>
            </p>
          </div>
        </div>
      </section>
    </div>

    <!-- JS -->
    <script src="../frontoffice/vendor/jquery/jquery.min.js"></script>
    <script src="../frontoffice/main.js"></script>
  </body>
  <!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
