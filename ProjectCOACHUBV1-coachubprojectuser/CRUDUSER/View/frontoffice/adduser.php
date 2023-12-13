<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In Page</title>
    <link rel="stylesheet" href="s.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="icon" type="image/png" href="#" />
  </head>
  <body>
    <section>
        <div class="content">
          <div class="left">
            <img src="https://i.postimg.cc/8CCmX23W/icon.png" alt="icon" />
            <h1>COACHUB</h1>
        </div>
    <div class="right">
          <div class="title">
            <h2>COACHUB</h2>
          </div>
        <form id="create-account-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- USERNAME -->

        <div class="input-group">
          <label for="nom">Name</label>
          <input type="text" id="nom" placeholder="Name" name="nom" />
          <p>Error Message</p>
        </div>

        <!-- USERprenom -->
        <div class="input-group">
          <label for="prenom">Prename</label>
          <input type="text" id="prenom" placeholder="Prename" name="prenom" />
          <p>Error Message</p>
        </div>
        <!-- ddn -->
        <div class="input-group">
          <label for="ddn">ddn</label>
          <input type="date" id="ddn" placeholder="ddn" name="ddn" />
          <p>Error Message</p>
        </div>
        <!-- USERNAME -->
        <div class="input-group">
          <label for="pays">pays</label>
          <input type="text" id="pays" placeholder="pays" name="pays" />
          <p>Error Message</p>
        </div>

        <!-- EMAIL -->
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email" name="email" />
          <p>Error Message</p>
        </div>

        <!-- PASSWORD -->
        <div class="input-group">
          <label for="mdp">Password</label>
          <input
            type="password"
            id="mdp"
            placeholder="Password"
            name="mdp"
          />
          <p>Error Message</p>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="input-group">
          <label for="cmdp">Confirm Password</label>
          <input
            type="password"
            id="cmdp"
            placeholder="Password"
            name="cmdp"
          />
          <p>Error Message</p>
         </div>

         <!-- sexe -->
        <div class="input-group">
          <label for="sexe">sexe</label>
          <input type="text" id="sexe" placeholder="sexe" name="sexe" />
          <p>Error Message</p>
        </div>
        <!-- type -->
        <div class="input-group">
          <label for="type">type</label>
          <input type="text" id="type" placeholder="type" name="type" />
          <p>Error Message</p>
        </div>
         <div class="create">
          <button type="submit">Create Account</button>
        </div>
       </form>

       <div class="additional">
        <p>
          Already have an account ?
          <span
            ><span
              ><a href="../login/login.html">Log In</a>
              <a href="../forgotpassword/forgotpass.html"
                >forgotpassword</a
              ></span
            ></span
          >
        </p>
       </div>

          <div class="or">
            <h3>OR</h3>
            <div class="sign">
              <button>
                <ion-icon name="logo-google"></ion-icon>
              </button>
              <button>
                <ion-icon name="logo-github"></ion-icon>
              </button>
            </div>
          </div>
     </div>
     </section>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <script src="app.js"></script>
  </body>
</html>



<?php
include'../../Model/user.class.php';
include'../../Model/config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : null;
    $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : null;
    $ddn = isset($_POST["ddn"]) ? $_POST["ddn"] : null;
    $pays = isset($_POST["pays"]) ? $_POST["pays"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : null;
    $cmdp = isset($_POST["cmdp"]) ? $_POST["cmdp"] : null;
    $sexe = isset($_POST["sexe"]) ? $_POST["sexe"] : null;
    $type = isset($_POST["type"]) ? $_POST["type"] : null;

    // Créer une instance de la classe User
    $user = new user(null, $nom, $prenom, $ddn, $pays, $email, $mdp, $cmdp, $sexe, $type);

    // Ajouter l'utilisateur à la base de données
    $conn = getConnexion();  // Assurez-vous que la fonction getConnexion() est correctement définie dans le fichier config.php
    $message = $user->addUser($conn);

    echo $message;

    // Fermer la connexion à la base de données
    $conn = null;
}
?>

