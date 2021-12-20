<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        ?>
          <script type="text/javascript">location.href = 'index.php';</script>
        <?php
    }
    if(!isset($_SESSION['editUser'])){
        ?>
          <script type="text/javascript">location.href = 'portfolio.php';</script>
        <?php
    }
    require 'assets/php/database.php';
    require 'assets/php/validate.php';
?>
<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit</title>
  <!-- View-port Basics: http://mzl.la/VYREaP -->
  <!-- This meta tag is used for mobile device to display the page without any zooming,
       so how much the device is able to fit on the screen is what's shown initially. 
       Remove comments from this tag, when you want to apply media queries to the website. -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="favicon.ico" />
  <!--font-awesome link for icons-->
  <link rel="stylesheet" media="screen" href="assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Default style-sheet is for 'media' type screen (color computer display).  -->
  <link rel="stylesheet" media="screen" href="assets/css/style.css">
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <p>Edit</p>
    </header>
    <!--header section start-->
    <!--main section start-->
    <main>
      <div class="wrapper">
        <?php 
            require 'assets/php/form.php';
        ?>
      </div>
    </main>
    <!--main section end-->
    <!--footer section start-->
    <footer>
      <p>Created By NDG.</p>
    </footer>
    <!--footer section end-->
  </div>
  <!--container end-->
  <script src="assets/js/script.js"></script>
</body>

</html>