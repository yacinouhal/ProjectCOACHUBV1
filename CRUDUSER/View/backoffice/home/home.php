<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>ProTrainer - Navbar</title>
   <link rel="stylesheet" href="home.css" />
  </head>
  <body>
    <nav class="navbar">
      <ul class="nav-list">
        <li>
          <a href="#"
            ><img class="logo-header" src="../assets/img/coachubblanc.svg" alt=""
          /></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropbtn">SPORTIF COACH </a>
          <div class="dropdown-content">
            <a href="#">Sports coaching at home</a>
            <div class="sub-dropdown">
              <a href="#" class="sub-dropbtn">Online sports coaching</a>
              <div class="sub-dropdown-content">
                <a href="#">Remote sports coaching</a>
                <a href="#">Video sports coaching</a>
              </div>
            </div>
          </div>
        </li>
        <li class="dropdown">
          <a href="#" class="dropbtn">ONLINE PROGRAM</a>
          <!-- <div class="dropdown-content">
            <a href="#">Yoga Class 1</a>
            <a href="#">Yoga Class 2</a>
            <a href="#">Yoga Class 3</a>
          </div> -->
        </li>
        <li><a href="#">PRODUCTS</a></li>
        <li><a href="#">A PROPOS</a></li>
        <li><a href="#">CONTACT</a></li>
        <li><a href="addpost.php">Forum</a></li>

        <li class="dropdown" id="hello">
          <a href="" class="dropbtn"
            ><img class="basket" src="../assets/img/profile.svg" alt=""
          /></a>

          <div class="dropdown-content">
            <a href="../profile/profile.php">Profil</a>
            <a href="#">LogOut</a>
          </div>
        </li>
        <!-- <li id="hi">
          <a href=""
            ><img class="login-icon" src="../assets/img/basket.svg" alt=""
          /></a>
        </li> -->
      </ul>
    </nav>
    <main class="home-main">
      <div class="header-main"></div>
    </main>
    <footer class="container-footer">
      <div class="login">
        <img class="logo-coachub" src="../assets/img/coachubblanc.svg" alt="" />
        <h3 class="h2-footer">
          <center>
            A question ? Need help or information ?
            <br />
            We are listening to you. Do not hesitate to contact us !
          </center>
        </h3>
        <form class="login-form" method="POST" action="insert.php">
          <input type="fullname" name="name" placeholder="your FullName " class="input" />
          <p class="fullname-failed"></p>
          <input
            type="text"
            name="contact"
            placeholder="your Email  'example@gmail.com'"
            class="input"
          />
          <p class="email-failed"></p>
          <textarea
            name="problem"
            cols="30"
            rows="10"
            placeholder="ho can I help you!"
          ></textarea>
          <button class="login-button" type="submit">Submit</button>
        </form>
        <?php
        // Assurez-vous que $listOfSubmissions est défini et n'est pas nul
        if (isset($listOfSubmissions) && is_array($listOfSubmissions)) {
            foreach ($listOfSubmissions as $submission):
        ?>
            <div>
                <p>Nom: <?php echo $submission['name']; ?></p>
                <p>Email/Téléphone: <?php echo $submission['contact']; ?></p>
                <p>Description du problème: <?php echo $submission['problem_description']; ?></p>

                <!-- Ajoutez un lien "Modifier" avec l'ID de soumission dans l'URL -->
                <a href="update_submission.php?submission_id=<?php echo $submission['submission_id']; ?>">Modifier</a>
            </div>
        <?php
            endforeach;
        } else {
            // Affichez un message si $listOfSubmissions n'est pas défini ou est nul
            exit;
        }
        ?>
    </div>
    </div>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
