<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>ProTrainer - Navbar</title>
    <link rel="stylesheet" href="profile.css" />
  </head>
  <body>
    <nav class="navbar">
      <ul class="nav-list">
        <li>
          <a href="#"
            ><img class="logo-header" src="../img/coachubblanc.svg" alt=""
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

        <li class="dropdown" id="hello">
          <a href="" class="dropbtn"
            ><img class="basket" src="../img/profile.svg" alt=""
          /></a>

          <div class="dropdown-content">
            <a href="./profile.html">Profil</a>
            <a href="#">LogOut</a>
          </div>
        </li>
        <!-- <li id="hi">
          <a href=""
            ><img class="login-icon" src="../img/basket.svg" alt=""
          /></a>
        </li> -->
      </ul>
    </nav>
    <main class="profil-main">
      <div class="container-profile-right">
        <div class="photo-profile"></div>
      </div>
      <div class="container-profile-left">
        <nav class="navbar-profile">
          <a href="#" class="tab-link active" onclick="showTab('home')"
            >OverView</a
          >
          <a href="#" class="tab-link" onclick="showTab('about')"
            >Update Profile</a
          >
          <a href="#" class="tab-link" onclick="showTab('services')"
            >Our Products</a
          >
          <a href="#" class="tab-link" onclick="showTab('contact')"
            >Change Password</a
          >
        </nav>

        <div class="tab-content" id="tabContent">
          <div class="tab-pane active" id="home">Home Content</div>
          <div class="tab-pane" id="about">About Content</div>
          <div class="tab-pane" id="services">Services Content</div>
          <div class="tab-pane" id="contact">Contact Content</div>
        </div>
      </div>
    </main>
    <footer class="container-footer">
      <div class="login">
        <img class="logo-coachub" src="../img/coachubblanc.svg" alt="" />
        <h3 class="h2-footer">
          <center>
            A question ? Need help or information ?
            <br />
            We are listening to you. Do not hesitate to contact us !
          </center>
        </h3>
        <form class="login-form">
          <input type="fullname" placeholder="your FullName " class="input" />
          <p class="fullname-failed"></p>
          <input
            type="email"
            placeholder="your Email  'example@gmail.com'"
            class="input"
          />
          <p class="email-failed"></p>
          <textarea
            name=""
            id=""
            cols="30"
            rows="10"
            placeholder="ho can I help you!"
          ></textarea>
          <div class="login-button">CONTACT US</div>
        </form>
      </div>
    </footer>

    <script src="profile.js"></script>
  </body>
</html>
