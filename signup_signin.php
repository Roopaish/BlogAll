<?php
// Variables

$email = "";
$name = "";
$password = "";
$error = "";
$success = "";
$from_signIn = false;
$from_signUp = false;

// From Landing Page

if(isset($_POST['signInUI'])){
  $from_signIn = true;
}

if(isset($_POST['signUpUI'])){
  $from_signUp = true;
  $email = $_POST['email'];
}

/* Database Creation*/

//Commented code is to run once to create database and tables

//Creating Database

require_once("connect.php");

// $sql = "CREATE DATABASE usersauth";
// $result = mysqli_query($connection, $sql);

// if(!$result){
//   echo "Error! ",mysqli_error($connection);
// }

//select database

$db = mysqli_select_db($connection, "usersauth");

if($_SERVER['REQUEST_METHOD']=="POST"){

  /* Signing up */

  if(isset($_POST['signUp'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $flag = 0;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $flag = 1;
      $error .= "Please enter a vaild email!<br/>";
    }else{

      $emaildb = "SELECT email FROM users";
      $result = mysqli_query($connection, $emaildb);

      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if($row['email'] == $email){
          $flag = 1;
          $error .= 'Email already taken!
                    <form id="signInUI" action="" method="POST" style="flex-direction:row;">
                      <button name="signInUI" class="notStyledBtn">Sign In</button>&nbsp;instead.
                    </form>';
        }
      }

    }

    if(!preg_match("/([A-Za-z ]+){5,}/", $name)){
      $flag = 1;
      $error .= "Please enter a valid name!<br/>";
    }

    if(!preg_match("/[\w\W]{6,12}/", $password)){
      $flag = 1;
      $error .= "Please enter password of 6 to 12 characters long!";
    }
    
    
    if($flag == 0){
      $error = "";

      if(!$db){
        echo "Connection Failed! ",mysqli_error($connection);
      }else{

        //Creating table columns(headings)

        // $sql = "CREATE TABLE users(
        //   id INT(6) PRIMARY KEY AUTO_INCREMENT,
        //   username TEXT(30),
        //   email VARCHAR(30),
        //   password VARCHAR(20)
        // )";


        //Inserting Values
        
        $sql = "INSERT INTO users(
          username, email, password
        )
        VALUES('$name', '$email', '$password')";

        $result = mysqli_query($connection, $sql);

        if(!$result){
          echo "Error! ",mysqli_error($connection);
        }else{
          $success = "Account Created!";
        }
      }

    }
  }

    /* Signing in */

  if(isset($_POST['signIn'])){
    $from_signIn = true;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $index = 0;
    $flag = 1;

    $authdb = "SELECT email, password FROM users";
    $result = mysqli_query($connection, $authdb);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      if($row['email'] == $email){
        $flag = 2;
        if($row['password'] == $password){
          $flag = 0;
          $success = "Authenticated!";
          }
        break;
        }
      }

    if($flag == 1){
      $error = 'Email is not taken!
                <form id="signUpUI" action="" method="POST" style="flex-direction:row;">
                  <button name="signUpUI" class="notStyledBtn">Sign Up</button>&nbsp;instead.
                </form>
      ';
    }elseif($flag == 2){
      $error = "Email or password is incorrect!";
    }

  }
}

mysqli_close($connection);

/* to store Html Code */

$sign_up_body = '
            <span class="error">'.$error.'</span>
            <span class="success">'.$success.'</span>
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
              
              <button name="signUp" class="styledBtn">Sign Up</button>
            </form>
';

$sign_in_body = '
            <span class="error">'.$error.'</span>
            <span class="success">'.$success.'</span>
            <form method="POST">

              <p class="input-wrap">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" value="'.$email.'" required>
              </p>

              <p class="input-wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
              </p>

              <button name="signIn" class="styledBtn">Sign In</button>
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
          <li><button class="styledBtn">Discover</button></li>
        </ul>
    </nav>


    <main class="signUpIn">
      <?php 
        if(!$from_signIn){
          echo $sign_up_body;
              
        }else{
          echo '<h1>Welcome back!</h1>';
          echo $sign_in_body;
        }
    ?>
    </main>
    <script src="app.js"></script>
  </body>
</html>