# BLOGALL

## Unlimited Blogs and more.
### Read anywhere. Post anytime.

>> Design : Netflix 

Implementation of HTML5, CSS, JS, PHP and MySQL

Note: connect.php file looks like this.
```php
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
```