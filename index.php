<?php


if(isset($_COOKIE['useremail']) && isset($_COOKIE['userpassword'])){
  header("Location: discover.php");
}

  echo '
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlogAll</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" type="image/png" href="./img/logo.png" />
      </head>

      <body>

        <section class="landing-page">

          <nav>
            <header>
              <a href="#">
                <img src="./img/blogall.png" alt="blogall-logo" />
              </a>
            </header>

            <ul>
              <li>
                <form action="signup_signin.php" method="POST">
                  <button name="signInUI" class="styledBtn">Sign In</button>
                </form>
              </li>
            </ul>
          </nav>

          <main class="landing-page-body">
            <h1>Unlimited blogs and more.</h1>
            <h2>Read anywhere. Post anytime.</h2>
            <h3>Ready to be a blogger? Enter your email to create or restart your blogship.
            </h3>

            <form action="signup_signin.php" method="POST">
              <p class="input-wrap">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
              </p>
              <button name="signUpUI" class="styledBtn">Get Started ></button>
            </form>

          </main>


        </section>

        <script src="app.js"></script>
      </body>

      </html>
    ';
?>