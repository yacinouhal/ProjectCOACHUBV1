<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- css link -->
    <link rel="stylesheet" href="Login.css" />
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
      <form class="login-form" >
        <input
          type="email"
          placeholder="your Email  'example@gmail.com'"
          class="input"
        />
        <p class="email-failed"></p>
        <input type="password" placeholder="your Password " class="input" />
        <p class="password-failed"></p>

        <div class="login-button">LOGIN</div>
        <a href="" class="Forget-password">Forget Password</a>
        <hr class="ligne" />
        <div class="socialmedia">
          
          <img class="email-login" src="google-svgrepo-com.svg" alt="" />
          <img class="github-login" src="github-svgrepo-com.svg" alt="" />
          <img class="linkedin-login" src="linkedin-svgrepo-com.svg" alt="" />
        </div>
</form>
    </div>
  </body>
</html>
