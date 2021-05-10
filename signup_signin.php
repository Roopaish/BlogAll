<?php
if($_SERVER['REQUEST_METHOD'] == "POST" ){
   $email = $_POST['email'];
}else{
  $email = "";
}

if(isset($_POST['signInUI'])){
  $from_signIn = true;
}else{
  $from_signIn = false;
}

if(isset($_POST['signUpUI'])){
  $from_signUp = true;
}else{
  $from_signUp = false;
}

$name = "";
$password = "";
if(isset($_POST['signUp'])){
  $email = $_POST['email'];
  $name = $_POST['name'];
  $password = $_POST['password'];

  if(!preg_match("/([A-Za-z ]+){5,}/", $name)){
    $error = "Please enter a valid name!";
  }else{
    $error = "";
  }
}

if(isset($_POST['signIn'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(!1){
    $error = "Please enter a valid name!";
  }else{
    $error = "";
  }
}

$sign_in = false;

$sign_up_body = '
            <span class="error">'.$error.'</span>
            <form method="POST">
              <p class="input-wrap">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" value="'.$email.'" required>
              </p>

              <p class="input-wrap">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="'.$name.'" required>
              </p>

              <p class="input-wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="'.$password.'" required>
              </p>
              
              <button name="signUp">Sign Up</button>
            </form>
';

$sign_in_body = '
            <span class="error">'.$error.'</span>
            <form method="POST">

              <p class="input-wrap">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" value="'.$email.'" required>
              </p>

              <p class="input-wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
              </p>

              <button name="signIn">Sign In</button>
            </form>
';

?>

<html>
  <head>
    <title>Sing Up | Sign In</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="./img/logo.png"/>
  </head>

  <body>
    <nav>
        <header>
          <a href="#">
            <img src="./img/blogall.png" alt="blogall-logo" />
          </a>
        </header>

        <ul>
          <li><button>Discover</button></li>
        </ul>
    </nav>


    <main class="signUpIn">
      <?php 
        if(!$sign_in){
          echo $sign_up_body;
              
        }else{
          if($from_signUp){
            echo '<h1>You already have an account! Sign In instead</h1>';
          }
          if($from_signIn){
            echo '<h1>Welcome back!</h1>';
          }
          echo $sign_in_body;
        }
    ?>
    </main>
    <script src="app.js"></script>
  </body>
</html>