<?php
// Connecting to database
  $hostname = "localhost";
  $username = "root";
  $password = "";

  $connection = mysqli_connect($hostname, $username, $password);

  if(!$connection){
    echo 'Failed to connect to database!';
  }
?>