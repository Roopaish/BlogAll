<?php

  $posts = array();
  $usernames = array();
  $headings = array();
  $dates = array();
  $page = 1;
  $i = 0;


  $profile = "B";
  $useremail = "";
  $username = "";
  $userpassword = "";
  $error = "";
  $success = "";

  include ("connect.php");

  if(!(isset($_COOKIE['useremail']) || isset($_COOKIE['username'])) && !isset($_COOKIE['userpassword'])){
    header('Location: index.php');
  }{
    $username = $_COOKIE['username'];
    $profile = strtoupper($username[0]);
    $db = mysqli_select_db($connection, "rupeshbudhathoki_usersauth");

    if(isset($_POST['createblog'])){
      $heading = $_POST['heading'];
      $content = $_POST['content'];

      if($db){
        $sql = "INSERT INTO posts(
          username,  heading, post, date
        )
        VALUES('$username', '$heading', '$content', CURTIME())";

        $result = mysqli_query($connection, $sql);

        if(!$result){
          $error = 'Error! '.mysqli_error($connection).'';
        }else{
          $success = "Post Created!";
          echo "<script>
                  setTimeout(\"location.href = 'discover.php';\",1500);
                </script>";
        }
      }else{
         $error = 'Error! '.mysqli_error($connection).'';
      }
    }

    if($db){
      
      $results_per_page = 10;

      $postdb = "SELECT * FROM posts";
      $result = mysqli_query($connection, $postdb);
      $number_of_result = mysqli_num_rows($result);
      
      $number_of_page = ceil($number_of_result / $results_per_page);

      if(isset($_GET['page'])){
        $page = $_GET['page'];
      }
      
      // Sql limit
      $page_first_result = ($page - 1) * $results_per_page;

      //retriving selected results
      $postdb =  "SELECT * FROM posts LIMIT " . $page_first_result . ',' . $results_per_page;  
      $result = mysqli_query($connection, $postdb);

    }else{
      $error = 'Error! '.mysqli_error($connection).'';
    }

  }


?>

<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Posts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="./img/logo.png"/>
  </head>

  <body>
    <div class="discover">
    <nav>
        <header>
          <a href="#">
            <img src="./img/blogall.png" alt="blogall-logo" />
          </a>
        </header>

        <ul>
          <li>
            <button class="styledBtn" id="newBlogBtn" name="newblog">New Blog</button>

            <section class="newblog hide" id="newblog">
            <form action="" method="POST" class="newBlogForm" id="newBlogForm">

              <p class="input-wrap">
                <label for="heading">Heading</label>
                <input type="text" name="heading" id="heading" required>
              </p>

              <p class="input-wrap">
                <label for="content">Content</label>
                <textarea type="content" name="content" id="content" required placeholder="         Use <br/> for line break! You can also use other HTML tags!(not recommended)"></textarea>
              </p>
              
              <button name="createblog" class="styledBtn">Create</button>
              </section>
            </form>

          </li>
          <li><button class="styledBtn profile" ><?php echo $profile ?></button></li>
        </ul>
    </nav>


    <main class="discover-posts">
      <section>
        <?php
          echo '
            <span class="success">'.$success.'</span>
            <span class="error">'.$error.'</span>
            ';

          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $row['post'][0] = strtoupper($row['post'][0]);
            echo ' 
           
            <article>
              <h3>'.$row['heading'].'</h3>
              <p class="author">Posted By: '.$row['username'].' ('.$row['date'].')</p>
              <p>'.$row['post'].'</p>
            </article>
          ';
          }
        ?>

        <div class="pagination" style="text-align:center; margin:2rem 0;">
          <?php
            //display the link of the pages in URL  
            for($page = 1; $page<= $number_of_page; $page++) {  
              echo '<a href = "discover.php?page=' . $page . '">' . $page . ' </a>';  
            } 
          ?> 
      </div>

        </section>
      </main>
      
    </div>
    <script src="app.js"></script>
  </body>
</html>

<?php
  mysqli_close($connection);
?>