<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- css link -->
    <link rel="stylesheet" href="registerView.css" />
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
      <img class="logo-coachub" src="coachubblanc.svg" alt="" />
      <div class="login-form">
        <input
          type="text"
          placeholder="your Name"
          class="input"
        />
        <p class="name-failed"></p>
        <input type="text" placeholder="your LastName " class="input" />
        <p class="lastname-failed"></p>

        <input type="date" placeholder="your dateof birth " class="input" />
        <p class="date-failed"></p>
        
           <select name="" id="" placeholder="Gouvernorat" class='select input'>
           
            <option value='0'>Tunis</option>
            <option value='1'>Ben Arous</option>
            <option value=''>Ariana</option>
            <option value=''>Médenine</option>
            <option value=''>Béja</option>
            <option value=''>Bizerte</option>
            <option value=''>Gabès</option>
            <option value=''>Gafsa</option>
            <option value=''>Jendouba</option>
            <option value=''>Kasserine</option>
            <option value=''>Kébili</option>
            <option value=''>Le Kef</option>
            <option value=''>Mahdia</option>
            <option value=''>	La Manouba</option>
            <option value=''>	Monastir</option>
            <option value=''>Nabeul</option>
            <option value=''>	Sfax</option>
            <option value=''>Siliana</option>
            <option value=''>Sousse</option>
            <option value=''>Sidi Bouzid</option>
            <option value=''>Tataouine</option>
            <option value=''>Tozeur</option>
            <option value=''>Zaghouan</option>
           
           </select>
        <p class="Gouvernorat-failed"></p>
        
         <input
          type="email"
          placeholder="your Email  'example@gmail.com'"
          class="input"
        />
        <p class="email-failed"></p>
        <input type="password" placeholder="your Password " class="input" />
        <p class="password-failed"></p>
       <input type="password" placeholder="your Confirm Password " class="input" />
        <p class="confirm-password-failed"></p>
      <select name="" id="" class='select input'>
        <option value="">femme</option>
        <option value="">Homme</option>
        </select>
        <p class="date-failed"></p>
        <select name="" id=""class='select input'>
        <option value="">coach</option>
        <option value="">adherent</option>
        </select>
        <div class="login-button">Signup</div>
        <!-- <a href="" class="Forget-password">Forget Password</a>
        <hr class="ligne" /> -->
        <!-- <div class="socialmedia">
          
          <img class="email-login" src="google-svgrepo-com.svg" alt="" />
          <img class="github-login" src="github-svgrepo-com.svg" alt="" />
          <img class="linkedin-login" src="linkedin-svgrepo-com.svg" alt="" />
        </div> -->
      </div>
    </div>
  </body>
</html>

